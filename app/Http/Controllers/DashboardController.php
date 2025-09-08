<?php
namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Summaryboxes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{

    public function dashboardAnalytics()
    {
        $userId = auth()->id();
        $modules = Module::orderByDesc('id')
            ->where('module_status', 'active')
            ->get();

        $sortModules = DB::table('sort_modules')
            ->where('user_id', $userId)
            ->whereIn('module_id', $modules->pluck('id'))
            ->get()
            ->keyBy('module_id');

        $modulesWithStatus = $modules->map(function ($module) use ($sortModules) {
            $moduleData = $sortModules[$module->id] ?? null;
            if (Auth::user()->hasRole(['staff']) && !Auth::user()->can('read ' . $module->module_slug)) {
                return null;
            }
            return [
                'module' => $module,
                'status' => $moduleData->status ?? '0',
                'position' => $moduleData->position ?? 0,
                'box_size' => $moduleData->box_size ?? 'col-md-6',
            ];
        })->filter()->sortBy('position')->values()->toArray();

        $file = [];
        $file['moduleListFormData'] = [];

        // Populate the forms with unique names and their action routes
        foreach ($modulesWithStatus as $moduleWithStatus) {

            $module = $moduleWithStatus['module'];
            $status = $moduleWithStatus['status'];
            if (Auth::user()->hasRole(['staff']) && !Auth::user()->can('read ' . $module->module_slug)) {
                continue;
            }

            $file['moduleListFormData'][] = [
                'name' => 'modulelist-form-' . $module->id,
                'module_slug' => $module->module_slug,
                'module_name' => $module->module_name,
                'box_size' => $moduleWithStatus['box_size'],
                'status' => $status,
                'module_id' => $module->id,
                'action' => route('dashboard.module', $module->module_slug),
                'btnGrid' => 2,
                'no_submit' => 1,
                'limit' => 5,
                'class-row' => 'col-md-3',
                'class-search' => 'col-md-12',
                'row-show' => 1,
                'fieldData' => [],
            ];
        }

        $excluded = ['administrators', 'role_has_permissions', 'personal_access_tokens', 'permissions', 'password_resets', 'nex_settings', 'module_fields', 'module', 'model_has_roles', 'model_has_permissions', 'migrations', 'failed_jobs', 'coupons', 'sidebar', 'roles', 'summary_boxes', 'sort_modules'];
        $key = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');
        $table_name = collect(array_column($tables, $key))
            ->filter(fn($table) => !in_array($table, $excluded))
            ->map(fn($item) => ['value' => $item, 'label' => ucfirst($item)]);

        $file['summaryFormData'] = [
            'name' => 'summarybox_form',
            'action' => route('boxes.store'),
            'method' => 'post',
            'submit' => 'Save Summary Box',
            'btnGrid' => 3,
            'no_submit' => true,
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'id',
                    'label' => '',
                    'placeholder' => 'id',
                    'value' => 0,
                    'grid' => '1',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'box_title',
                    'label' => 'Title',
                    'placeholder' => 'Title',
                    'value' => '',
                    'grid' => '3',

                ],
                [
                    'tag' => 'select',
                    'name' => 'aggregate_val',
                    'label' => 'Aggregate Value',
                    'element_extra_classes' => 'select2',
                    'element_extra_attributes' => '',
                    'outer_div_classes' => '',
                    'data' => [
                        ['value' => 'count', 'label' => 'Count'],
                        ['value' => 'sum', 'label' => 'Sum'],
                        ['value' => 'avg', 'label' => 'Average'],
                        ['value' => 'max', 'label' => 'Maximum'],
                        ['value' => 'min', 'label' => 'Minimum'],
                    ],
                    'grid' => '3',
                ],
                [
                    'tag' => 'select',
                    'name' => 'table_name',
                    'label' => 'Table Name',
                    'element_extra_classes' => 'select2',
                    'element_extra_attributes' => '',
                    'data' => $table_name,
                    'grid' => '3',
                ],
                [
                    'tag' => 'select',
                    'name' => 'column_name',
                    'label' => 'Column Name',
                    'element_extra_classes' => 'select2',
                    'element_extra_attributes' => '',
                    'data' => [],
                    'grid' => '3',
                ],
                [
                    'tag' => 'select',
                    'name' => 'box_icon',
                    'label' => 'Icon',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'data' => [],
                    'grid' => '3',
                ],
                [
                    'tag' => 'select',
                    'name' => 'box_theme',
                    'label' => 'Theme',
                    'element_extra_classes' => 'select2InModal',
                    'element_extra_attributes' => '',
                    'outer_div_classes' => '',
                    'data' => [
                        ['value' => 'primary', 'label' => 'Primary'],
                        ['value' => 'secondary', 'label' => 'Secondary'],
                        ['value' => 'success', 'label' => 'Success'],
                        ['value' => 'danger', 'label' => 'Danger'],
                        ['value' => 'warning', 'label' => 'Warning'],
                        ['value' => 'info', 'label' => 'Info'],
                        ['value' => 'light', 'label' => 'Light'],
                        ['value' => 'dark', 'label' => 'Dark'],
                    ],
                    'grid' => '3',
                ],
                [
                    'tag' => 'submit',
                    'name' => 'save_summarybox',
                    'value' => 'Save Summary Box',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'grid' => '6',
                ],
            ],
        ];

        $summeybox = Summaryboxes::orderBy('box_sort')->get();
        $file['summeybox'] = [];

        foreach ($summeybox as $boxes) {
            if (!Schema::hasTable($boxes->table_name)) {
                // Delete the record if the table does not exist
                Summaryboxes::where('id', $boxes->id)->delete();
                continue; // Skip this iteration
            }
            $box_value = DB::table($boxes->table_name)
                ->select(DB::raw($boxes->aggregate_val . '(' . $boxes->column_name . ') as box_val'))
                ->first() ?? 0;

            $box_val = $box_value->box_val ?? 0;
            $file['summeybox'][] = [
                'id' => $boxes->id,
                'box_title' => $boxes->box_title,
                'aggregate_val' => $boxes->aggregate_val,
                'table_name' => $boxes->table_name,
                'column_name' => $boxes->column_name,
                'box_icon' => $boxes->box_icon,
                'box_theme' => $boxes->box_theme,
                'box_sort' => $boxes->box_sort,
                'status' => $boxes->status,
                'box_val' => (floor((float) $box_val) == (float) $box_val) ? (int) $box_val : number_format((float) $box_val, 2, '.', ''),
            ];
        }

        $file['moduleListFormData']['Data'] = $modulesWithStatus;

        $summerBtn = '';
        $moduleBtn = '';
        if (Auth::user()->hasRole(['supperadmin'])) {
            $summerBtn = '<a href="javascript:void(0)" id="summarybox" type="button" class="h4" style="font-size: 20px;"><i data-feather="grid" style="height: 20px;width: 24px;"></i></a>';
        }
        if (!empty($modulesWithStatus)) {
            $moduleBtn = '<a href="javascript:void(0)" id="module-list-toggle" type="button" class="h4" style="font-size: 20px;">
                <i data-feather="list" style="height: 24px;width: 24px;"></i>&nbsp;
            </a>';
        }

        $data1['breadcrumbButton']['button'] = $summerBtn . ' ' . $moduleBtn;

        return view('content.dashboard.dashboard-analytics', $file, $data1);
    }

    public function ModuleDashboard(Request $request, $slug)
    {
        if ($request->ajax()) {

            $userId = auth()->id();

            try {

                $module = Module::where('module_slug', $slug)->firstOrFail();

                $fields = DB::table('module_fields')
                    ->where('module_id', $module->id)
                    ->where('table_status', '1')
                    ->get();

                // Relational field data
                $relationalData = $fields->where('is_relational', '1')->map(function ($field) {
                    return [
                        'name' => $field->name,
                        'field_type' => $field->fields,
                        'relational_table' => $field->relational_table,
                        'relational_table_label_field' => $field->relational_table_label_field,
                        'relational_table_value_field' => $field->relational_table_value_field,
                    ];
                })->toArray();
                $ralational_names = array_column($relationalData, 'name');

                $badge_data = $fields->where('fields', 'badge')->map(function ($field) {
                    $options = json_decode($field->options, true);
                    return [
                        'name' => $field->name,
                        'field_type' => $field->fields,
                        'options' => array_map('strtolower', $options),
                        'badge_color' => json_decode($field->badge_color)
                    ];
                })->toArray();

                $badge_names = array_column($badge_data, 'name');

                // Fetch the module's data
                $columns = $fields->pluck('name')->toArray();
                $col = [...$columns];
                $columns = [...$columns, "updated_at"];
                $sortBy = $request->sort ? $request->sort : "id";
                $sortDirection = $request->direction ? $request->direction : "desc";

                $thead = [];

                foreach ($fields as $field) {
                    $thead[] = [
                        'title' => $field->title,
                        'col' => $field->name,
                        'is_sort' => true,
                    ];
                }
                $thead[] = [
                    'title' => "Update Date",
                    'col' => "updated_at",
                    'is_sort' => true,
                ];

                $tableData = db::table($module->table_name)
                    ->select($columns)
                    ->orderBy($sortBy, $sortDirection);
                // Apply search and status filters if provided
                if (!empty($request->search)) {
                    $tableData->where(function ($query) use ($request, $columns) {
                        foreach ($columns as $column) {
                            $query->orWhere($column, 'LIKE', '%' . $request->search . "%");
                        }
                    });
                }

                $limit = $request->limit ? $request->limit : 5;
                $tbody = $tableData->paginate($limit);
                $tbody_data = $tbody->items();

                // Process each row and handle relational fields, file paths, and default values
                foreach ($tbody_data as $key => $row) {
                    $row = (array) $row;
                    foreach ($row as $rowkey => $rowval) {
                        $filePath = json_decode($rowval, true);

                        if (json_last_error() === JSON_ERROR_NONE && is_array($filePath) && is_string($filePath[0]) && !empty($filePath) && str_starts_with($filePath[0], 'module_uploads/' . $module->table_name . '')) {

                            $img_path = asset((!empty($filePath[0]) && file_exists(public_path($filePath[0]))) ? $filePath[0] : "module_uploads/no_image.jpg");

                            $countdiv = count($filePath) > 1 ? '<span class="preview_btn " >+' . count($filePath) - 1 . '</span>' : '';

                            $row[$rowkey] = '<div style="position:relative;"><img src="' . $img_path . '" class="rounded show_img" alt="Image" />' . $countdiv . "</div>";
                        } else {
                            if (in_array($rowkey, $ralational_names) && !empty($rowval)) {
                                $matchingData = array_filter($relationalData, function ($data) use ($rowkey) {
                                    return $data['name'] === $rowkey;
                                });
                                $matchingData = reset($matchingData);

                                $relational_table = $matchingData['relational_table'];
                                $label_field = $matchingData['relational_table_label_field'];
                                $value_field = $matchingData['relational_table_value_field'];

                                $acticon = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? 'first' : 'get';
                                $condition = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? 'where' : 'whereIn';
                                $rowval = ($matchingData['field_type'] == "select" || $matchingData['field_type'] == "radio") ? $rowval : json_decode($rowval);

                                $table_data = DB::table($relational_table)->select($label_field)->{$condition}($value_field, $rowval)->{$acticon}();

                                $row[$rowkey] = $acticon == "get" ? implode(',', $table_data->pluck($label_field)->toArray()) : $table_data->{$label_field};
                            } else if (in_array($rowkey, $badge_names) && !empty($rowval)) {
                                $matchBadge = [];

                                $matchBadge = array_filter($badge_data, function ($data) use ($rowkey) {
                                    return $data['name'] === $rowkey;
                                });
                                $matchBadge = reset($matchBadge);
                                $bg_color=($index = array_search($rowval, $matchBadge['options'])) !== false
                                    ? $matchBadge['badge_color'][$index] ?? '#000000'
                                    : '#000000';
                                $row[$rowkey] = '<span class="badge rounded-pill" style="background-color:'.$bg_color.'; opacity: 1;">'.$rowval.'</span>';
                            } else {
                                $row[$rowkey] = !empty($rowval)
                                    ? (json_last_error() === JSON_ERROR_NONE && is_array($filePath) && is_string($filePath[0]) && !empty($filePath)
                                        ? implode(',', $filePath)
                                        : (str_word_count($rowval) > 6                                   // Check if the value has more than 15 words
                                            ? implode(' ', array_slice(explode(' ', $rowval), 0, 5)) . '...' // Show first 6 words with "..."
                                            : $rowval))                                                      // Otherwise, show the original value
                                    : '--';
                            }
                        }
                    }

                    $tbody_data[$key] = [...(array) $row];
                }

                // Set the updated collection to the paginator
                $tbody->setCollection(new Collection($tbody_data));

                return view('datatable.datatablev2', compact('tbody', 'col', 'thead', 'sortBy', 'sortDirection'));
            } catch (\Exception $e) {
                return response()->json(['error' => 'Module not found or something went wrong.']);
            }
        }
    }

    // Dashboard - Ecommerce
    public function dashboardEcommerce()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }

    public function saveOrder(Request $request)
    {

        if ($request->ajax()) {
            $order = $request->input('order');
            $userId = auth()->id();

            foreach ($order as $index => $moduleId) {
                DB::table('sort_modules')->updateOrInsert(
                    ['user_id' => $userId, 'module_id' => $moduleId],
                    ['position' => $index + 1, 'updated_at' => now(), 'created_at' => DB::raw('COALESCE(created_at, NOW())')]
                );
            }

            return response()->json(['message' => 'Position updated successfully']);
        }
        $order = json_decode($request->input('order'));
        $statuses = json_decode($request->input('statuses'), true); // Decode as an associative array
        $userId = auth()->id();

        foreach ($order as $index => $moduleId) {
            $newStatus = $statuses[$moduleId] ?? '1';

            DB::table('sort_modules')->updateOrInsert(
                ['user_id' => $userId, 'module_id' => $moduleId],
                [
                    'position' => $index + 1,
                    'status' => $newStatus,
                    'updated_at' => now(),
                    'created_at' => DB::raw('COALESCE(created_at, NOW())'), // Preserve existing `created_at`
                ]
            );
        }

        return redirect()->route('admin.dashboard')->with('message', 'Position updated successfully!');
    }

    public function updateColumnSize(Request $request)
    {
        if ($request->ajax()) {
            $moduleId = $request->input('moduleid');
            $columnSize = $request->input('columnsize');
            $userId = auth()->id();

            $Update = DB::table('sort_modules')->updateOrInsert(
                ['user_id' => $userId, 'module_id' => $moduleId],
                ['box_size' => $columnSize, 'updated_at' => now(), 'created_at' => DB::raw('COALESCE(created_at, NOW())')]
            );

            $response = $Update ? ['status' => 200, 'message' => 'Size updated successfully'] : ['status' => 400, 'message' => 'Size not updated'];
            return response()->json($response);
        }
    }
}
