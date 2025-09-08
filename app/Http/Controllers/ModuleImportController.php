<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use Carbon\Carbon;

class ModuleImportController extends Controller
{
    protected $temporary_folder = '';
    public function importData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt,xlsx,xls', // Allow CSV, XLSX, and XLS files
            'zip_file' => 'nullable|file|mimes:zip', // Allow Only Zip files
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $file = $request->file('file');
        $slug = $request->input('slug');
        $zipFile = $request->file('zip_file');


        $module = Module::with('fields')
            ->where('module_slug', $slug)
            ->where('form_type', '!=', 'no_form')
            ->first();

        if (!$module || $module->fields->isEmpty()) {
            return response()->json([
                'status' => $module ? 400 : 404,
                'message' => $module ? 'Fields not found' : 'Module not found'
            ]);
        }

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.import')) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }

        $fields = $module->fields;

        if ($zipFile) {
            $destinationPath = public_path('module_uploads/' . $module->table_name . '_' . encrypt_to(Auth::id()));

            $this->temporary_folder = $destinationPath;

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }


            $zipFileName = time() . '_' . $zipFile->getClientOriginalName();
            $zipFile->move($destinationPath, $zipFileName);
            $zipFilePath = $destinationPath . '/' . $zipFileName;
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath) === true) {
                $zip->extractTo($destinationPath);
                $zip->close();
                File::delete($zipFilePath);
                $extractedFiles = File::files($destinationPath);

                foreach ($extractedFiles as $extractedFile) {
                    // $extension = strtolower($extractedFile->getExtension());
                    // if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $newFilePath = $destinationPath . '/' . $extractedFile->getFilename();
                    File::move($extractedFile->getPathname(), $newFilePath);
                    // }
                }
            } else {
                return response()->json(['status' => 404, 'message' => 'Failed to extract the ZIP file']);
            }
        }

        $extension = $file->getClientOriginalExtension();

        if ($extension === 'csv') {
            return $this->importCSV($file, $fields, $module);
        } elseif (in_array($extension, ['xlsx', 'xls'])) {
            return $this->importExcel($file, $fields, $module);
        } else {
            return response()->json(['status' => 400, 'message' => 'Unsupported file type']);
        }
    }

    protected function importCSV($file, $fields, $module)
    {
        // Step 1: Read the CSV file and separate headers and data
        $data = array_map('str_getcsv', file($file));
        $headers = $data[0];
        $data = array_slice($data, 1);

        // Step 2: Extract relational field information from the fields
        $relationalFields = $fields->where('is_relational', '1');

        $relationalData = $relationalFields->map(function ($field) {
            return [
                'name' => $field->name,
                'field_type' => $field->fields,
                'relational_table' => $field->relational_table,
                'relational_table_label_field' => $field->relational_table_label_field,
                'relational_table_value_field' => $field->relational_table_value_field,
            ];
        })->toArray();

        // Step 3: Identify relational field names
        $relationalNames = array_column($relationalData, 'name');
        $validHeaders = $fields->pluck('name')->toArray();


        $FilesFields = $fields->whereIn('fields', ['single_file', 'multiple_file'])->pluck('name')->toArray();




        if ($headers !== $validHeaders) {
            return response()->json(['status' => 400, 'message' => 'CSV headers do not match the expected format.']);
        }


        $headers = array_intersect($headers, $validHeaders);
        $skiprowCount = [];
        $insertData = [];

        // Step 4: Process each row of the CSV
        foreach ($data as $Dataindex => $row) {
            $data_slug = null;
            $dataToInsert = [];
            $skipRow = false;

            foreach ($headers as $index => $header) {
                $field = $fields->firstWhere('name', $validHeaders[$index]);
                // print_r( $Dataindex.' '.$field->name);
                if ($field) {
                    $columnName = $field->name;
                    $rowval = $row[$index];

                    if (($field->required == 1 || $field->is_slug == 1) && empty($rowval)) {
                        $skipRow = true;
                        $skiprowCount[] = "Skipping row " . ($Dataindex + 2) . ": The required field '{$field->name}' is empty.";
                        break; // Stop processing this row
                    }

                    if ($field->is_slug == 1) {
                        $data_slug = $original_slug = Str::slug($rowval);
                        if (!empty($data_slug)) {
                            $all_slugs = array_merge(
                                DB::table($module->table_name)->pluck('slug')->toArray(),
                                array_column($insertData, 'slug')
                            );
                            while (in_array($data_slug, $all_slugs)) {
                                $data_slug = $original_slug . '-' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 4);
                            }
                        }
                    }

                    //Handle relational fields
                    if (in_array($columnName, $relationalNames) && !empty($rowval)) {

                        if (empty($rowval)) {
                            $dataToInsert[$columnName] = null;
                        } else {

                            $matchingData = array_filter($relationalData, function ($data) use ($columnName) {
                                return $data['name'] === $columnName;
                            });
                            $matchingData = reset($matchingData);

                            // Relational table and fields
                            $relational_table = $matchingData['relational_table'];
                            $label_field = $matchingData['relational_table_label_field'];
                            $value_field = $matchingData['relational_table_value_field'];

                            // Step 5: Process row value for relational field (remove duplicates)
                            if (is_string($rowval)) {
                                // If row value is a string (comma-separated), convert to array
                                $rowval = explode(',', $rowval);
                            }

                            // Ensure unique values for relational IDs (removing duplicates)
                            $rowval = array_unique($rowval);

                            // Step 6: Query the relational table to get distinct items
                            $acticon = in_array($matchingData['field_type'], ['select', 'radio']) ? 'first' : 'get';
                            $condition = in_array($matchingData['field_type'], ['select', 'radio']) ? 'where' : 'whereIn';
                            $rowval = in_array($matchingData['field_type'], ['select', 'radio']) ? $rowval[0] : $rowval;



                            $relatedItems = DB::table($relational_table)
                                    ->{$condition}($label_field, $rowval)
                                // ->distinct() // Ensure distinct records from relational table
                                ->{$acticon}();


                            if ($relatedItems) {

                                // Step 7: If `get` method is used, ensure we get unique values
                                if ($acticon == "get") {
                                    $relatedItems = $relatedItems->unique($label_field)->pluck($value_field)->toArray();
                                }

                                // Step 8: Assign the relational data (JSON encoded if needed)
                                $dataToInsert[$columnName] = $acticon == "get" ? json_encode(array_map('strval', $relatedItems)) : $relatedItems->{$value_field};
                            } else {
                                if ($field->required == 1 && !$relatedItems) {
                                    $skipRow = true;
                                    $skiprowCount[] = "Row " . ($Dataindex + 2) . " skipped: Required relational field '{$field->name}' is missing.";
                                    break;
                                } else {
                                    $dataToInsert[$columnName] = null;
                                }
                            }
                        }

                    } else if (in_array($columnName, $FilesFields) && !empty($rowval)) {
                        $rowval = explode(',', $rowval);
                        $newFilePaths = [];
                        $allowedMimeTypes = json_decode($field->file_types);

                        foreach ($rowval as $fileName) {
                            $fileName = trim($fileName);

                            // Define source and destination paths
                            $sourcePath = $this->temporary_folder . '/' . $fileName;
                            $destinationFolder = 'module_uploads/' . $module->table_name;

                            // Create destination folder if it doesn't exist
                            if (!File::exists(public_path($destinationFolder))) {
                                File::makeDirectory(public_path($destinationFolder), 0755, true);
                            }

                            if (!file_exists($sourcePath)) {
                                $skipRow = true;
                                $skiprowCount[] = "Skipping row " . ($Dataindex + 2) . ": File '{$fileName}' could not be found in the zip archive.";
                                continue;
                            }

                            $mimeType = mime_content_type($sourcePath);

                            if (!in_array($mimeType, $allowedMimeTypes)) {
                                $skipRow = true;
                                $skiprowCount[] = "Skipping row " . ($Dataindex + 2) . ": File '{$fileName}' type '{$mimeType}' is not allowed for field '{$field->name}'.";
                                continue; // Skip this file, but continue with the rest
                            }

                            // Generate new random file name with extension
                            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                            $newFileName = rand(100000, 999999) . '.' . $fileExt;

                            $destinationPath = public_path($destinationFolder . '/' . $newFileName);

                            // Move the file from the temp folder to the destination folder
                            if (file_exists($sourcePath)) {
                                // Move the file using copy and delete original if successful
                                if (copy($sourcePath, $destinationPath)) {
                                    // unlink($sourcePath);
                                    // Optionally delete the original file from temp folder
                                    $newFilePaths[] = $destinationFolder . '/' . $newFileName; // Store the path for later use
                                }
                            }
                        }

                        $dataToInsert[$columnName] = !empty($newFilePaths) ? json_encode($newFilePaths) : null;



                        // If field is single_file or multiple_file, prepend file path
                        // if (in_array($field->fields, ['single_file', 'multiple_file'])) {

                        //     $rowval = array_map(fn($val,$module) => 'module_uploads/'.$module->table_name .'/' . trim($val), $rowval);
                        // }
                        // $dataToInsert[$columnName] = !empty($rowval) ? json_encode($rowval) : null;
                    } else {
                        if (in_array($field->fields, ['multiple_select', 'checkbox', 'single_file', 'multiple_file', 'repeater']) && !empty($rowval)) {
                            // $rowval= explode(',', $rowval);
                            // $dataToInsert[$columnName] = !empty($rowval) ? json_encode($rowval) : null;
                            $rowval = explode(',', $rowval);

                            // If field is single_file or multiple_file, prepend file path
                            if (in_array($field->fields, ['single_file', 'multiple_file'])) {
                                $rowval = array_map(fn($val) => 'module_uploads/' . $module->table_name . '/' . trim($val), $rowval);
                            }
                            $dataToInsert[$columnName] = !empty($rowval) ? json_encode($rowval) : null;
                        } else {
                            // Non-relational fields, just assign the value directly
                            if (in_array($field->fields, ['date', 'datetime-local']) && !empty($rowval)) {
                                $format = $field->fields === 'date' ? 'Y-m-d' : 'Y-m-d H:i:s';
                                $dataToInsert[$columnName] = date($format, strtotime($rowval));
                            } else {
                                $dataToInsert[$columnName] = $rowval ?? null;
                            }
                        }
                    }
                }
            }

            if ($skipRow) {
                continue;
            }

            if (!$skipRow) {
                $dataToInsert['slug'] = $data_slug ?? null;
                $dataToInsert['created_at'] = now();
                $dataToInsert['updated_at'] = now();
                $insertData[] = $dataToInsert;
            }
        }

        // Batch insert using array_chunk
        foreach (array_chunk($insertData, 500) as $chunk) {
            DB::table($module->table_name)->insert($chunk);
        }

        if ($this->temporary_folder != '' && File::exists($this->temporary_folder)) {
            File::deleteDirectory($this->temporary_folder);
        }

        // Step 12: Return a success message
        return response()->json(['status' => 200, 'message' => 'CSV data imported successfully!', 'skiprow' => $skiprowCount]);
    }

    // Handle Excel file import
    protected function importExcel($file, $fields, $module)
    {
        try {
            $importData = Excel::toCollection(new \stdClass(), filePath: $file);
            $sheetData = $importData->first();
            $headers = $sheetData->first();
            $rows = $sheetData->slice(1);

            $validHeaders = $fields->pluck('name')->toArray();


            $relationalFields = $fields->where('is_relational', '1');
            $relationalData = $relationalFields->map(function ($field) {
                return [
                    'name' => $field->name,
                    'field_type' => $field->fields,
                    'relational_table' => $field->relational_table,
                    'relational_table_label_field' => $field->relational_table_label_field,
                    'relational_table_value_field' => $field->relational_table_value_field,
                ];
            })->toArray();
            // Map relational field names
            $relationalNames = array_column($relationalData, 'name');



            $skiprowCount = [];
            $insertData = [];

            $headersArray = $headers->toArray();

            if ($headersArray !== $validHeaders) {
                return response()->json(['status' => 400, 'message' => 'Excel headers do not match the expected format.']);
            }

            foreach ($rows as $Dataindex => $row) {
                $data_slug = null;
                $dataToInsert = [];
                $skipRow = false;


                foreach ($headers as $index => $header) {
                    $columnName = $header; // Use the header as the column name
                    $field = $fields->firstWhere('name', $columnName);
                    $rowval = $row[$index];

                    if ($field) { // Match field by name
                        $columnName = $field->name;

                        if (($field->required == 1 || $field->is_slug == 1) && empty($rowval)) {
                            $skipRow = true;
                            $skiprowCount[] = "Skipping row " . ($Dataindex + 2) . ": The required field '{$field->name}' is empty.";
                            break; // Stop processing this row
                        }
                        if ($field->is_slug == 1) {
                            $data_slug = $original_slug = Str::slug($rowval);

                            if (!empty($data_slug)) {
                                $all_slugs = array_merge(
                                    DB::table($module->table_name)->pluck('slug')->toArray(),
                                    array_column($insertData, 'slug')
                                );
                                while (in_array($data_slug, $all_slugs)) {
                                    $data_slug = $original_slug . '-' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 4);
                                }
                            }
                        }

                        if (in_array($columnName, $relationalNames) && !empty($rowval)) {
                            if (empty($rowval)) {
                                $dataToInsert[$columnName] = null;
                            } else {

                                $matchingData = array_filter($relationalData, function ($data) use ($columnName) {
                                    return $data['name'] === $columnName;
                                });
                                $matchingData = reset($matchingData);

                                // Relational table and fields
                                $relational_table = $matchingData['relational_table'];
                                $label_field = $matchingData['relational_table_label_field'];
                                $value_field = $matchingData['relational_table_value_field'];

                                // Step 5: Process row value for relational field (remove duplicates)
                                if (is_string($rowval)) {
                                    // If row value is a string (comma-separated), convert to array
                                    $rowval = explode(',', $rowval);
                                }

                                // Ensure unique values for relational IDs (removing duplicates)
                                $rowval = array_unique($rowval);

                                // Step 6: Query the relational table to get distinct items
                                $acticon = in_array($matchingData['field_type'], ['select', 'radio']) ? 'first' : 'get';
                                $condition = in_array($matchingData['field_type'], ['select', 'radio']) ? 'where' : 'whereIn';
                                $rowval = in_array($matchingData['field_type'], ['select', 'radio']) ? $rowval[0] : $rowval;



                                $relatedItems = DB::table($relational_table)
                                        ->{$condition}($label_field, $rowval)
                                    // ->distinct() // Ensure distinct records from relational table
                                    ->{$acticon}();


                                if ($relatedItems) {

                                    // Step 7: If `get` method is used, ensure we get unique values
                                    if ($acticon == "get") {
                                        $relatedItems = $relatedItems->unique($label_field)->pluck($value_field)->toArray();
                                    }

                                    // Step 8: Assign the relational data (JSON encoded if needed)
                                    $dataToInsert[$columnName] = $acticon == "get" ? json_encode(array_map('strval', $relatedItems)) : $relatedItems->{$value_field};
                                } else {
                                    if ($field->required == 1 && !$relatedItems) {
                                        $skipRow = true;
                                        $skiprowCount[] = "Row " . ($Dataindex + 2) . " skipped: Required relational field '{$field->name}' is missing.";
                                        break;
                                    } else {
                                        $dataToInsert[$columnName] = null;
                                    }
                                }
                            }
                        } else {
                            if (in_array($field->fields, ['multiple_select', 'checkbox', 'single_file', 'multiple_file', 'repeater']) && !empty($rowval)) {

                                $rowval = explode(',', $rowval);

                                // If field is single_file or multiple_file, prepend file path
                                if (in_array($field->fields, ['single_file', 'multiple_file'])) {
                                    $rowval = array_map(fn($val) => 'module_uploads/' . $module->table_name . '/' . trim($val), $rowval);
                                }
                                $dataToInsert[$columnName] = !empty($rowval) ? json_encode($rowval) : null;
                            } else {
                                // Non-relational fields, just assign the value directly
                                if (in_array($field->fields, ['date', 'datetime-local', 'time']) && !empty($rowval)) {
                                    if (in_array($field->fields, ['time'])) {
                                        $seconds = $rowval * 86400; // Convert fractional day to total seconds
                                        $Value = Carbon::createFromTimestamp($seconds)->format('H:i:s');
                                    } else {
                                        $format = $field->fields === 'date' ? 'Y-m-d' : 'Y-m-d H:i:s';
                                        $Value = date($format, strtotime($rowval));
                                    }
                                    $dataToInsert[$columnName] = $Value;
                                } else {
                                    $dataToInsert[$columnName] = $rowval ?? null;
                                }
                            }
                        }
                    }
                }

                if ($skipRow) {
                    continue;
                }

                if (!$skipRow) {
                    $dataToInsert['slug'] = $data_slug ?? null;
                    $dataToInsert['created_at'] = now();
                    $dataToInsert['updated_at'] = now();
                    $insertData[] = $dataToInsert;
                }

                // $dataToInsert['created_at'] = now();
                // $dataToInsert['updated_at'] = now();

                // DB::table($module->table_name)->insert($dataToInsert);
            }
            foreach (array_chunk($insertData, 500) as $chunk) {
                DB::table($module->table_name)->insert($chunk);
            }

            return response()->json(['status' => 200, 'message' => 'Excel data imported successfully!', 'skiprow' => $skiprowCount]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => 'Error processing Excel file: ' . $e->getMessage()]);
        }
    }

}

