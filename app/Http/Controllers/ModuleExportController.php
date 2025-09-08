<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ModuleExport;
use App\Models\Module;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// For Excel Export
class ModuleExportController extends Controller
{
    public function exportData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'export_type' => 'required|in:csv,excel,pdf',
            'fields' => 'required|array|min:1',
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $slug = $request->slug;
        $type = $request->export_type;
        $selectedFields = $request->fields;

        $module = Module::with('fields')
            ->where('module_slug', $slug)
            ->where('form_type', '!=', 'no_form')
            ->whereHas('fields')
            ->first();

        if (!$module || $module->fields->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => $module ? 'Fields not found' : 'Module not found'
            ], 400);
        }

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.export')) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }

        $filename = $module->module_name;
        $fields = $module->fields;

        $ImageNames = $fields
            ->whereIn('fields', ['multiple_file', 'single_file'])
            ->pluck('name')
            ->toArray();
        $repeaterContainer = $fields
            ->whereIn('fields', ['container_repeater'])
            ->pluck('name')
            ->toArray();


        $relationalFields = $fields->where('is_relational', '1');
        $relational_data = $relationalFields->map(function ($field) {
            return [
                'name' => $field->name,
                'field_type' => $field->fields,
                'relational_table' => $field->relational_table,
                'relational_table_label_field' => $field->relational_table_label_field,
                'relational_table_value_field' => $field->relational_table_value_field,
            ];
        })->toArray();
        $relationalNames = array_column($relational_data, 'name');

        $thead = $selectedFields;

        $query = DB::table($module->table_name)
            ->select($selectedFields);

        $data = $query->orderBy('id', 'DESC')->get();


        if ($data->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'No data found.'], 404);
        }

        foreach ($data as $key => $row) {
            $row = (array) $row;

            // Handle relational fields
            foreach ($row as $rowkey => $rowval) {

                if (in_array($rowkey, $relationalNames) && !empty($rowval)) {
                    $matchingData = [];

                    $matchingData = array_filter($relational_data, function ($data) use ($rowkey) {
                        return $data['name'] === $rowkey;
                    });
                    $matchingData = reset($matchingData); // Get the first match if multiple exist



                    // Access other relational data fields
                    $relational_table = $matchingData['relational_table'];
                    $label_field = $matchingData['relational_table_label_field'];
                    $value_field = $matchingData['relational_table_value_field'];

                    $acticon = in_array($matchingData['field_type'], ['select', 'radio']) ? 'first' : 'get';
                    $condition = in_array($matchingData['field_type'], ['select', 'radio']) ? 'where' : 'whereIn';
                    $rowval = in_array($matchingData['field_type'], ['select', 'radio']) ? $rowval : json_decode($rowval);

                    $query = DB::table($relational_table)->select($label_field)->{$condition}($value_field, $rowval);

                    $Relational_tabledata = $acticon == 'first' ? $query->first() : $query->get();

                    $row[$rowkey] = !empty($Relational_tabledata) ? ($acticon == "get" ? implode(',', $Relational_tabledata->pluck($label_field)->toArray()) : $Relational_tabledata->{$label_field}) : '--';
                } else {
                    if (in_array($rowkey, $ImageNames) && !empty($rowval)) {
                        $row[$rowkey] = implode(',', array_map(fn($path) => asset($path), (array) json_decode($rowval, true) ?? []));
                    } else if (in_array($rowkey, $repeaterContainer) && !empty($rowval)) {
                        $row[$rowkey] = !empty($rowval) ? $rowval : null;
                    } else {
                        $ValueArr = json_decode($rowval, true);
                        $row[$rowkey] = !empty($rowval)
                            ? (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && !empty($ValueArr)
                                ? implode(',', $ValueArr)
                                : $rowval)
                            : null;
                    }
                }
            }


            $data[$key] = $row;
        }
        $exportMethods = [
            'csv' => 'exportCSV',
            'excel' => 'exportExcel',
            'pdf' => 'exportPDF'
        ];
        return isset($exportMethods[$type])
            ? $this->{$exportMethods[$type]}($data, $thead, $filename)
            : response()->json(['status' => 400, 'message' => 'Invalid export type']);
    }

    public function exportCSV($data, $thead, $filemodule)
    {
        $filename = "export_" . $filemodule . now()->format('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        return response()->stream(function () use ($data, $thead) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $thead);

            foreach ($data as $item) {
                fputcsv($handle, (array) $item);
            }

            fclose($handle);
        }, 200, $headers);
    }

    // Export to Excel
    public function exportExcel($data, $thead, $filename)
    {
        $filename = "export_" . $filename . now()->format('Y-m-d_H-i-s') . ".xlsx";
        return Excel::download(new ModuleExport($data, $thead), $filename);
    }

    public function exportPDF($data, $thead, $filename)
    {
        PDF::setOption('isHtml5ParserEnabled', true);
        PDF::setOption('isPhpEnabled', true);
        $filename = "export_" . $filename . now()->format('Y-m-d_H-i-s') . ".pdf";
        $pdf = PDF::setOptions(['isPhpEnabled' => true])->loadView('exports.pdf', ['data' => $data, 'thead' => $thead]);

        $htmlContent = view('exports.pdf', ['data' => $data, 'thead' => $thead])->render();
        return $pdf->download($filename);
    }
}
