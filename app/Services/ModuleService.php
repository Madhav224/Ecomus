<?php
namespace App\Services;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ModuleService
{
    #====================================================================================================================================================
    #============================================================ModuleService Start=====================================================================
    #====================================================================================================================================================

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Create Services For Dynamic Module Data Get Api (Single Or Multiple)
    public function readModuleData(Request $request, $slug, $id = null)
    {
        $module = Module::where('module_slug', $slug)->first();

        if (!$module)
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        $api_action = !empty($module->api_actions) ? (in_array('read', json_decode($module->api_actions)) ? true : false) : false;

        if ($module->has_api == "0" || $api_action == false)
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );


        $fields = $module->fields;

        $relational_data = $fields->where('is_relational', '1')->map(function ($field) {
            return [
                'name' => $field->name,
                'field_type' => $field->fields,
                'relational_table' => $field->relational_table,
                'relational_table_label_field' => $field->relational_table_label_field,
                'relational_table_value_field' => $field->relational_table_value_field,
            ];
        })->toArray();


        $ralational_names = array_column($relational_data, 'name');


        $Data = DB::table($module->table_name)->select('*')->orderBy('id', 'DESC');

        if (isset($request->search) && !empty($request->search)) {

            $Data->where(function ($query) use ($fields, $request) {
                foreach ($fields as $field) {
                    if ($field->fields == 'text' || $field->fields == 'email' || $field->fields == 'textarea' || $field->fields == 'text_editor') {
                        $query->orWhere($field->name, 'LIKE', '%' . $request->search . '%');
                    }
                }
            });

        }

        if (isset($request->where) && !empty($request->where)) {
            $Data->where($request->where);
        }

        $limit = $request->limit ? $request->limit : 100;

        // $Data = ($id > 0) ? $Data->where('id', $id)->get() : $Data->paginate($limit);
        $Data = $id ? $Data->where(is_numeric($id) ? 'id' : 'slug', $id)->get() : $Data->paginate($limit);

        $module_data = [];


        foreach ($Data as $key => $row) {

            $row = (array) $row;
            foreach ($row as $rowkey => $rowval) {


                $ValueArr = json_decode($rowval, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && !empty($ValueArr) && str_starts_with($ValueArr[0], 'module_uploads/' . $module->table_name . '')) {


                    $validImages = array_filter($ValueArr, function ($imagePath) {
                        return file_exists(public_path($imagePath));
                    });

                    if (count($validImages) === 1) {
                        // Single valid image
                        $row[$rowkey] = asset($validImages[0]);
                    } elseif (count($validImages) > 1) {
                        // Multiple valid images
                        $row[$rowkey] = array_map(function ($imagePath) {
                            return asset($imagePath);
                        }, $validImages);
                    } else {
                        // No valid images
                        $row[$rowkey] = asset("module_uploads/no_image.jpg");
                    }

                } else {
                    if (in_array($rowkey, $ralational_names) && !empty($rowval)) {
                        $matchingData = [];

                        $matchingData = array_filter($relational_data, function ($data) use ($rowkey) {
                            return $data['name'] === $rowkey;
                        });
                        $matchingData = reset($matchingData); // Get the first match if multiple exist

                        // Access other relational data fields
                        $relational_table = $matchingData['relational_table'];
                        $label_field = $matchingData['relational_table_label_field'];
                        $value_field = $matchingData['relational_table_value_field'];

                        $acticon = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? 'first' : 'get';
                        $condition = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? 'where' : 'whereIn';
                        $rowval = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? $rowval : json_decode($rowval);


                        $table_data = DB::table($relational_table)->select($label_field, $value_field)->{$condition}($value_field, $rowval)->{$acticon}();


                        if ($acticon == "get") {
                            // Ensure $table_data is a collection
                            $table_data = collect($table_data);

                            $row[$rowkey] = $table_data->map(function ($data) use ($label_field, $value_field) {
                                return [
                                    $label_field => $data->{$label_field},
                                    $value_field => $data->{$value_field},
                                ];
                            })->toArray();
                        } else {
                            // Handle cases where $acticon is not "get" (e.g., first, find, etc.)
                            if ($table_data) {
                                $row[$rowkey] = [
                                    $label_field => $table_data->{$label_field},
                                    $value_field => $table_data->{$value_field},
                                ];
                            }
                        }

                    } else
                        $row[$rowkey] = !empty($rowval)
                            ? (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && !empty($ValueArr)
                                ? $ValueArr
                                : $rowval)
                            : null;
                }
            }
            $module_data[] = $row;

        }

        $responseData = !empty($module_data)
            ? ['Status' => 200, 'Message' => 'Data found succesfully', 'Data' => count($module_data) > 1 ? $module_data : $module_data[0]]
            : ['Status' => 400, 'Message' => 'Data not found', 'Data' => []];

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Dynamic Module Record Insert Or Update Api
    public function storeModuleData(Request $request, $slug, $id = 0)
    {
        $module = Module::with(
            'fields'
        )->where('module_slug', $slug)->first();

        if (!$module)
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        $permission = empty($id) || $id == 0 ? 'create' : 'update';

        $api_action = !empty($module->api_actions) ? (in_array($permission, json_decode($module->api_actions)) ? true : false) : false;

        if ($module->has_api == "0" || $api_action == false)
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );


        $table_name = $module->table_name;

        $data = $request->all();
        $InsertOrUpdate = [];

        foreach ($data as $key => $value) {
            if ($request->hasFile(key: $key)) {

                // Handle single file upload
                if ($request->file($key)) {
                    $files = $request->file($key);
                    $file_arr = is_array($files) ? '1' : '0'; //check for single file or multiple files
                    $files = is_array($files) ? $files : [$files];
                }

                $allpath = [];
                // Create Array of file path and file store in folder(which create dynamically)
                foreach ($files as $file) {

                    if ($file->isValid()) {
                        $directory = 'module_uploads/' . $table_name;
                        $filename = rand() . '.' . $file->getClientOriginalExtension();
                        $filePath = $directory . '/' . $filename;

                        // Create the directory if it doesn't exist
                        if (!File::exists(public_path($directory))) {
                            File::makeDirectory(public_path($directory), 0755, true);
                        }

                        $file->move(public_path($directory), $filename);
                        $allpath[] = $filePath;
                    }
                }

                if ($id > 0) {
                    if ($file_arr === '0') {
                        //condition for single file and delete old single file
                        $module_table = Db::table($table_name)->select($key)->where('id', $id)->first();

                        if (!empty($module_table->$key)) {
                            $images = json_decode($module_table->$key);
                            $filePath = public_path($images[0]);

                            if (File::exists($filePath)) {
                                File::delete($filePath);
                            }
                        }
                    } else if ($file_arr === '1') {
                        // codition for multiple file and merge old and new file
                        $module_table = Db::table($table_name)->select($key)->where('id', $id)->first();

                        if (!empty($module_table->$key)) {
                            $old_images = json_decode($module_table->$key);
                            $allpath = array_merge($old_images, $allpath);
                        }

                    }
                }
                $InsertOrUpdate[$key] = json_encode($allpath);

            } else {
                $InsertOrUpdate[$key] = is_array($value) ? json_encode($value) : ($value ?? null);
            }

        }

        // id grether than 0 then update data otherwise insert data
        if ($id > 0) {
            // for update data
            $InsertOrUpdate['updated_at'] = now();
            $upadted = DB::table($table_name)->where('id', $id)->update($InsertOrUpdate);

            $responseData = $upadted
                ? ['Status' => 200, 'Message' => 'Record updated successfully.']
                : ['Status' => 400, 'Message' => 'Record could not be updated.'];
        } else {
            // for insert data
            $InsertOrUpdate['status'] = 'active';
            $InsertOrUpdate['created_at'] = now();
            $InsertOrUpdate['updated_at'] = now();
            $inserted = DB::table($table_name)->insert($InsertOrUpdate);

            $responseData = $inserted
                ? ['Status' => 200, 'Message' => 'Record saved successfully.']
                : ['Status' => 400, 'Message' => 'Record could not be saved.'];

        }

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Dynamic Module Record Delete Api
    public function deleteModuleData($slug, $id)
    {

        $module = Module::with([
            'fields' => function ($query) {
                $query->whereIn('fields', ['multiple_file', 'single_file']);
            }
        ])
            ->where('module_slug', $slug)
            ->where('module_status', 'active')
            ->first();


        if (!$module)
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        $api_action = !empty($module->api_actions) ? (in_array('delete', json_decode($module->api_actions)) ? true : false) : false;

        if ($module->has_api == "0" || $api_action == false)
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );


        $tablename = $module->table_name;


        foreach ($module->fields as $value) {
            $field_name = $value->name;
            $module_table = Db::table($tablename)->select($field_name)->where('id', $id)->first();

            if (!empty($module_table->$field_name)) {

                $images = json_decode($module_table->$field_name);

                foreach ($images as $img) {
                    $filePath = public_path($img);

                    if (File::exists($filePath))
                        File::delete($filePath);
                }
            }
        }

        $dynamic_module = Db::table($tablename)->where(is_numeric($id) ? 'id' : 'slug', $id)->delete();


        $responseData = !empty($dynamic_module)
            ? ['Status' => 200, 'Message' => 'Data Delete succesfully']
            : ['Status' => 404, 'Message' => 'Data does not Delete'];

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #API to Retrieve Field Names and Types
    public function getValidationInfo($slug)
    {

        $module = Module::with('fields')->where('module_slug', $slug)->first();

        // dd( $module);
        if (!$module)
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        if ($module->has_api == "0")
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );


        $fields = $module->fields->map(function ($field) use ($module) {
            $fieldType = $field->fields;

            // Format field types
            $fieldType = match ($field->fields) {
                'number' => 'number',
                'checkbox', 'multiple_select' => 'Array',
                'single_file' => 'file',
                'multiple_file' => 'files',
                'datetime-local' => 'Y-m-d H:i:s',
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'color' => 'hexadecimal color code',
                default => 'text',
            };

            $example = match ($field->fields) {
                'text' => 'Some text example',
                'number' => '123',
                'email' => 'example@demo.com',
                'password' => 'Pa$$w0rd!',
                'single_file' => ["file1.jpg"],
                'multiple_file' => ["file1.txt", "file2.jpg"],
                'select' => 'demo_option',
                'multiple_select' => ["option1", "option2"],
                'radio' => 'demo_option',
                'checkbox' => ["option1", "option2"],
                'textarea' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, hic?',
                'text_editor' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, hic?</p>',
                'datetime-local' => '2025-01-28 14:30:00',
                'date' => '2025-01-28',
                'time' => '14:30:00',
                'color' => '#ff0000',
                default => 'Some text example',
            };

            return [
                'name' => $field->name,
                'field' => $field->fields,
                'field_type' => $fieldType,
                'example' => $example,
                'required' => $field->is_required == 1 ? true : false,
                'is_relational' => $field->is_relational == 1 ? true : false,
                'data' => $field->is_relational == 1 ? route('module_api.realtional_data', [$module->module_slug, $field->name]) : (($field->is_relational == 0 && in_array($field->fields, ['radio', 'checkbox', 'select', 'multiple_select', 'badge'])) ? route('module_api.fetch_data', [$module->module_slug, $field->name]) : null),
            ];
        })->toArray();

        $responseData = !empty($fields)
            ? ['Status' => 200, 'Message' => 'Data found succesfully', 'Data' => $fields]
            : ['Status' => 400, 'Message' => 'Data not found', 'Data' => []];

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #API to Fetch Data from Relational Tables
    public function getRelationalData($slug, $field_name)
    {

        $module = Module::with([
            'fields' => function ($query) use ($field_name) {
                $query->where('name', $field_name)
                    ->where('is_relational', '1')
                    ->whereNotNull('relational_table')
                    ->whereNotNull('relational_table_label_field')
                    ->whereNotNull('relational_table_value_field');
            }
        ])
            ->where('module_slug', $slug)
            ->first();

        if (!$module || !$module->fields->contains('name', $field_name))
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        if ($module->has_api == "0")
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );

        $field = $module->fields->first();
        $relational_data = DB::table($field->relational_table)->select($field->relational_table_label_field, $field->relational_table_value_field)->get();

        if ($relational_data) {
            $data = [
                'field_name' => $field->name,
                'data' => []
            ];
            $data['data'] = $relational_data->map(function ($relational_data) use ($field) {
                return [
                    'label' => ucfirst($relational_data->{$field->relational_table_label_field}),
                    'value' => $relational_data->{$field->relational_table_value_field},
                ];
            })->toArray();
        }

        $responseData = $relational_data && !empty($relational_data)
            ? ['Status' => 200, 'Message' => 'Data found succesfully', 'Data' => $data]
            : ['Status' => 400, 'Message' => 'Data not found', 'Data' => []];

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------


    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Api to Fetch Data (radio,checkbox,select,multiple_select,badge) Data

    public function fetch_data($slug, $field_name)
    {

        $module = Module::with([
            'fields' => function ($query) use ($field_name) {
                $query->where('name', $field_name)
                    ->where('is_relational', '0');
            }
        ])
            ->where('module_slug', $slug)
            ->first();

        if (!$module || !$module->fields->contains('name', $field_name))
            return makeResponse(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        if ($module->has_api == "0")
            return makeResponse(
                ['Status' => 400, 'code' => 401, 'Message' => 'Permission to access this API is denied.', 'Data' => []]
            );

        $field = $module->fields->first();
        $fetch_data = json_decode($field->options);
        if ($fetch_data) {
            $data = [
                'field_name' => $field->name,
                'data' => []
            ];
            $color_data = $field->fields === "badge" ? json_decode($field->badge_color) : [];
            $data['data'] = array_map(function ($option, $index) use ($field, $color_data) {
                return [
                    'label' => ucfirst($option),
                    'value' => $option,
                    'bg_color' => ($field->fields === "badge" && isset($color_data[$index])) ? $color_data[$index] : null,
                ];
            }, $fetch_data, array_keys($fetch_data));
        }

        $responseData = $fetch_data && !empty($fetch_data)
            ? ['Status' => 200, 'Message' => 'Data found succesfully', 'Data' => $data]
            : ['Status' => 400, 'Message' => 'Data not found', 'Data' => []];

        return makeResponse($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #====================================================================================================================================================
    #============================================================ModuleService End=======================================================================
    #====================================================================================================================================================


}
