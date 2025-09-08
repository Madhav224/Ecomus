<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Models\Module;
use App\Models\Module_fields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Exception;

class ModuleController extends Controller
{


    #=================================================================================================================
    #================================= Dynamic Module Functions ======================================================
    #=================================================================================================================


    #-----------------------------------------------------------------------------------------------------------------
    #module Index Fucntion for Show Data Of Module..
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Data = Module::with('fields')->orderByDesc('id');

            $thead = ['Action', 'Module Name', 'Module Slug', 'Form type', 'UpdateDate'];
            $nhed = [];
            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('module_name', 'LIKE', '%' . $request->search . "%");
                });
            }
            if (!empty($request->form_type)) {
                $Data->where('form_type', $request->form_type);
            }
            if (!empty($request->module_status)) {
                $Data->where('module_status', $request->module_status);
            }

            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);

            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {


                $disabled = $data->fields->isEmpty() ? "disabled" : "";
                $viewurl = !empty($data->module_slug) ? route('show.datatable', $data->module_slug) : "javascript:void(0)";
                $editurl = !empty($data->module_slug) ? route('module_form', $data->module_slug) : "javascript:void(0)";


                $disabledClass = ($data->fields->isEmpty() || $data->form_type == "no_form") ? 'disabled-link' : '';

                $tbody_data[$key] =
                    [
                        '
                        <a href="javascript:void(0);"  class="avatar  avatar-status bg-light-success form-sorting-btn ' . ($disabledClass) . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Form Sorting" data-mid="' . encrypt_to($data->id) . '">
                        <span class="avatar-content" >
                            <i data-feather=\'layout\' class="avatar-icon"></i>
                        </span>
                        </a>


                        <a href="javascript:void(0);" class="avatar avatar-status bg-light-warning table-sort-btn ' . ($disabledClass) . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Table Sorting" data-mid="' . encrypt_to($data->id) . '">
                        <span class="avatar-content">
                            <i data-feather=\'list\' class="avatar-icon"></i>
                        </span>
                        </a>

                        <a href="' . $viewurl . '" class="avatar avatar-status bg-light-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Module" >
                        <span class="avatar-content">
                            <i data-feather=\'eye\' class="avatar-icon"></i>
                        </span>
                        </a>
                         <a href="javascript:void(0);" class="avatar avatar-status bg-light-primary duplicate_module_btn ' . ($disabledClass) . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Duplicate Module" data-moduleid="' . encrypt_to($data->id) . '">
                        <span class="avatar-content">
                            <i data-feather=\'copy\' class="avatar-icon"></i>
                        </span>
                        </a>
                         <a href="javascript:void(0);" class="avatar avatar-status bg-light-success filter_btn ' . ($disabledClass) . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Module Filters" data-moduleid="' . encrypt_to($data->id) . '">
                        <span class="avatar-content">
                            <i data-feather=\'filter\' class="avatar-icon"></i>
                        </span>
                        </a>

                        <a href="' . $editurl . '" class="avatar avatar-status bg-light-info " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="editnews/' . $data->id . '" data-id="' . $data->id . '">
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                        </a>

                          <a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'module/delete/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>

                        <div class="datatable-switch form-check form-switch form-check-primary1 d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->module_status == 'active' ? 'Deactivate' : 'Activate') . '">
                            <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->module_status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('module') . '/' . encrypt_to($data->id) . '/' . encrypt_to('module_status') . '"/>
                                <label class="form-check-label" for="StatusSwitch' . $key . '">
                                    <span class="switch-icon-left new-icon-x"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right new-icon-x"><i data-feather="x"></i></span>
                                </label>
                            </div>',
                        $data->module_name ?? '--',
                        $data->module_slug ?? '--',
                        $data->form_type ?? '--',
                        $data->updated_at,
                    ];
            }
            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        // Prepare data to pass to the view
        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],
            // ['link' => "javascript:void(0)", 'name' => "News"],
            ['name' => ucwords("Module list")],
        ];
        $file['title'] = ucwords("Module list");


        $file['ModuleFilterData'] = [
            'name' => 'Module',
            'action' => route('module.index'),
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [
                [
                    'tag' => 'select',
                    'roles' => [],
                    'type' => '',
                    'label' => 'Form Type',
                    'name' => 'form_type',
                    'validation' => '',
                    'grid' => 12,
                    'data' => [
                        [
                            'label' => 'Form In Model',
                            'value' => 'model'
                        ],
                        [
                            'label' => 'Form In One Page',
                            'value' => 'form'
                        ],
                        [
                            'label' => 'Not Form',
                            'value' => 'no_form'
                        ]
                    ],
                    'outer_div_classes' => 'mb-0',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => ''
                ],
                [
                    'tag' => 'select',
                    'roles' => [],
                    'type' => '',
                    'label' => 'Status',
                    'name' => 'module_status',
                    'validation' => '',
                    'grid' => 12,
                    'data' => [
                        [
                            'label' => 'Active',
                            'value' => 'active'
                        ],
                        [
                            'label' => 'Deactive',
                            'value' => 'deactive'
                        ]
                    ],
                    'outer_div_classes' => 'mb-0',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => ''
                ]
            ],
        ];



        // $file['modules'] = Module::with('fields')->orderByDesc('id')->paginate(perPage: 1);

        return view('module.index', $file);
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------
    #Open New Form and Edit Form
    public function form($slug = null)
    {
        $module = Module::with('fields')->where('module_slug', $slug)->first();
        return view('module.form', compact('module'));
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------

    # Store and Upadate Dynamic Module....

    public function store(StoreModuleRequest $request)
    {
        $moduleid = $request->input('module_id', '0');

        if ($moduleid == '0' || empty($request->input('table_name'))) {
            // $table_name= ; // Replace extra whitespace and special characters with an underscore (_)
            $table_name = $this->generatetablename(strtolower(preg_replace('/[^\w]+/', '_', $request->module_name))); //genrate unqiue table name
        } else {
            $table_name = $request->input('table_name');
        }

        // Slug the module_name
        $module_slug = Str::slug($request->input('module_name'));
        $has_api = $request->input('has_api', '0');

        // Create or update the module based on id..
        $module = Module::updateOrCreate(
            ['id' => $request->input('module_id')], // Condition for update or create new module
            [
                'table_name' => $table_name,
                'module_name' => $request->input('module_name', 'null'),
                'module_slug' => $module_slug ?? null,
                'form_type' => $request->input('form_type', 'null'),
                'has_api' => $has_api,
                'api_actions' => $has_api == 1 ? json_encode($request->input('api_actions', null)) : null,
                // 'action_add' => empty($request->input('data')) || $request->input('form_type') == "no_form" ? '0' : '1',
                'created_by' => Auth::id(),
            ]
        );

        $TableArray = [
            'table_name' => $module->table_name,
            'fields' => []
        ];


        if (!empty($request->input('data'))) {
            foreach ($request->input('data') as $key => $fieldData) {
                $repeater_fields = (!empty($fieldData['repeater']) && in_array($fieldData['fields'], ['container_repeater']))
                    ? json_encode(array_values(array_map(fn($item) => isset($item['name'])
                        ? array_merge($item, ['name' => strtolower(preg_replace('/[^\w]+/', '_', $item['name']))])
                        : $item, $fieldData['repeater'])))
                    : null;

                //file types convert into json form
                $file_types = isset($fieldData['file_types']) && !empty($fieldData['file_types']) && in_array($fieldData['fields'], ['single_file', 'multiple_file'])
                    ? json_encode($fieldData['file_types'])
                    : null;

                // options convert array to json form
                $options = isset($fieldData['options']) && !empty($fieldData['options']) && in_array($fieldData['fields'], ['radio', 'checkbox', 'select', 'multiple_select', 'badge'])
                    ? json_encode($fieldData['options'])
                    : null;

                $name = isset($fieldData['name'])
                    ? strtolower(preg_replace('/[^\w]+/', '_', $fieldData['name']))
                    : null;

                $oldname = isset($fieldData['oldname'])
                    ? $fieldData['oldname'] : $name;


                if ($name != $oldname) {
                    // if new and old name not match update column of table
                    $this->rename_column($module->table_name, $oldname, $name);
                }

                $fieldData['default_value'] = isset($fieldData['options_val']) && !empty($fieldData['options_val'])
                    ? json_encode($fieldData['options_val'])
                    : ($fieldData['default_value'] ?? null);


                $is_relational = in_array($fieldData['fields'], ['multiple_select', 'select']) && $fieldData['is_relational'] === "dynamic_data" ? "1" : "0";

                $badge_color = in_array($fieldData['fields'], ['badge']) ? json_encode($fieldData['badge_color']) : null;


                $module_fields = Module_fields::updateOrCreate(
                    [
                        'id' => $fieldData['field_id'] ?? '0', // Condition for update or create new modmodule_fieldsule
                    ],
                    [
                        'module_id' => $module->id,
                        'name' => $name,
                        'title' => $fieldData['title'] ?? null,
                        'file_types' => $file_types,
                        'repeater_fields' => $repeater_fields,
                        'fields' => $fieldData['fields'] ?? null,
                        'placeholder' => $fieldData['placeholder'] ?? null,
                        'default_val' => $fieldData['default_value'] ?? null,
                        'required' => $fieldData['required'] ?? '0',
                        'options' => $options,
                        'form_sort' => $fieldData['position'] ?? $key,
                        'is_relational' => $is_relational,
                        'relational_table' => $is_relational == "1" ? $fieldData['relational_table'] : null,
                        'relational_table_label_field' => $is_relational == "1" ? $fieldData['relational_table_label_field'] : null,
                        'relational_table_value_field' => $is_relational == "1" ? $fieldData['relational_table_value_field'] : null,
                        'badge_color' => $badge_color
                    ]
                );

                $field = [
                    'name' => $name,
                    'type' => match ($fieldData['fields']) {
                        'date' => 'DATE',
                        'time' => 'TIME',
                        'datetime-local' => 'DATETIME',
                        default => 'TEXT',
                    },
                    'nullable' => isset($fieldData['required']) && $fieldData['required'] == '1' ? false : true,
                    'default' => $fieldData['default_value'] ?? null,
                ];

                $data[] = $field;
            }
            $TableArray['fields'] = $data;
        }

        $response = $this->dynamic_table($TableArray);

        // $responseArray = json_decode($response, true);
        $responseArray = $response->getData(); // This returns an object

        if (isset($responseArray->status) && $responseArray->status == 200) {

            $responseData = ['success' => true, 'status' => 200, 'message' => 'The module has been successfully saved.'];
        } else {
            $responseData = ['success' => false, 'status' => 400, 'message' => 'Module could not be saved.'];
        }
        return response()->json($responseData);
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    # Create a New Database Table or Update an Existing Table Column
    private function dynamic_table($TableArray)
    {
        // dd($TableArray);
        $tablename = $TableArray['table_name'];
        $fields = $TableArray['fields'];

        if (!Schema::hasTable($TableArray['table_name'])) {
            Schema::create($tablename, function (Blueprint $table) use ($fields) {
                $table->id();
                $table->string('slug')->unique()->nullable();
                foreach ($fields as $field) {
                    $column = $table->{$field['type']}($field['name']); //, $field['length']

                    if (!empty($field['nullable']) && $field['nullable']) {
                        $column->nullable();
                    }

                    // if (isset($field['default'])) {
                    //     $column->default($field['default']);
                    // }
                }
                $table->enum('status', ['active', 'deactive'])->default('active');
                $table->timestamps(); // Add timestamps by default
            });
            return response()->json(['success' => true, 'status' => 200, 'message' => "Table '.$tablename.'created successfully."]);
        } else {
            // Update the existing table
            Schema::table($tablename, function (Blueprint $table) use ($fields, $tablename) {
                foreach ($fields as $field) {
                    if (!Schema::hasColumn($tablename, $field['name'])) {
                        // Add new column
                        $column = $table->{$field['type']}($field['name']); //, $field['length']

                        if (!empty($field['nullable']) && $field['nullable']) {
                            $column->nullable();
                        }

                        // if (isset($field['default'])) {
                        //     $column->default($field['default']);
                        // }
                    } else {

                        $column = DB::selectOne("SHOW COLUMNS FROM `$tablename` WHERE Field = ?", [$field['name']]);

                        if (
                            $column && (
                                $column->Type !== $field['type'] ||
                                ($column->Null === 'YES') !== $field['nullable'] ||
                                $column->Default !== ($field['default'] ?? null)
                            )
                        ) {
                            DB::statement("ALTER TABLE `$tablename` CHANGE `{$field['name']}` `{$field['name']}` {$field['type']} " .
                                ($field['nullable'] ? 'NULL' : 'NOT NULL') .
                                (isset($field['default']) ? " DEFAULT '{$field['default']}'" : ''));
                        }
                    }
                }
            });

            return response()->json(['success' => true, 'status' => 200, 'message' => "Table $tablename updated successfully."]);
        }
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    #Generate a Unique Name for a Database Table
    private function generatetablename($base_name)
    {
        $base_name = 'module_' . ltrim($base_name, 'module_');
        $table_name = $base_name;
        while (
            DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_name', $table_name)
                ->exists()
        ) {

            $table_name = $base_name . '_' . rand(100, 999);
        }
        return $table_name;
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------
    #Function to rename an existing column in a database table
    private function rename_column($tablename, $old, $new)
    {
        $type = DB::selectOne("SHOW COLUMNS FROM `$tablename` WHERE Field = ?", [$old])->Type;
        DB::statement("ALTER TABLE `$tablename` CHANGE `$old` `$new` $type");
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    # Display Module or Module Fields Data for Sorting and Module Status
    public function show_fields(Request $request)
    {

        $id = decrypt_to($request->id);
        $module = Module::with('fields')->find($id);
        $responseText = $module && !empty($module) ?
            ['status' => 200, 'message' => 'Module Found Succesfully..', 'data' => $module]
            :
            ['status' => 404, 'message' => 'Module Not Found', 'data' => null];
        return response()->json($responseText);
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------
    # Update Sorting (Form or Table View)
    public function update_fields(Request $request)
    {
        $FiledsData = $request->json()->all();
        $sort_type = $FiledsData['type'];
        foreach ($FiledsData['data'] as $filed) {
            $module = Module_fields::find($filed['id']);
            if ($module) {
                $module->$sort_type = $filed['position'];
                if ($sort_type == 'form_sort') {
                    $module->layout_class = $filed['layout_class'];
                    $module->is_slug = $filed['is_slug'] ?? '0';
                }
                $module->save();
            }
        }

        if ($sort_type == 'form_sort')
            $responsetext = ['status' => 200, 'message' => 'Form structure sorting updated successfully !'];
        else if ($sort_type == 'table_sort')
            $responsetext = ['status' => 200, 'message' => 'Table structure and sorting updated successfully !'];
        else
            $responsetext = ['status' => 500, 'message' => 'Failed to update sorting !'];

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------
    #Modify Table Display Fields and Update Module Status (Update, Delete, Status)
    public function change_table_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feild_id' => 'required|array|min:1',
        ], [
            'feild_id.required' => 'select at least one Feild.'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $module_id = $request->module_id;
        $feild_id = $request->feild_id;

        $update_action = Module::where('id', $module_id)->update([
            "action_update" => $request->input('update', '0'),
            "action_delete" => $request->input('delete', '0'),
            "action_status" => $request->input('status', '0'),
            "action_view" => $request->input('view', '0'),
            "action_add" => $request->input('add', '0'),
            "import_btn" => $request->input('import', '0'),
            "export_btn" => $request->input('export', '0'),
        ]);


        $update_fields = new Module_fields;
        $update_fields->where('module_id', $module_id)->whereIn('id', $feild_id)->update(['table_status' => '1']); //1=active
        $update_fields->where('module_id', $module_id)->whereNotIn('id', $feild_id)->update(['table_status' => '0']); //0=deactive

        if ($update_action && $update_fields) {
            $module = module_fields::where('module_id', $module_id)->where('table_status', '1')->get();
            $responsetext = ['status' => 200, 'message' => 'Table actions and displayed fields updated successfully.', 'data' => $module];
        } else {

            $responsetext = ['status' => 400, 'message' => 'Failed to update table actions and displayed fields!', 'data' => null];
        }

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    #Update Filter Feilds of Module
    public function update_filter_feilds(Request $request)
    {
        $module_id = $request->moduleId;
        $feild_id = $request->is_filterId;

        if (!empty($feild_id)) {

            $update_fields = new Module_fields;
            $update_fields->where('module_id', $module_id)->whereIn('id', $feild_id)->update(['is_filter' => '1']); //1=active
            $update_fields->where('module_id', $module_id)->whereNotIn('id', $feild_id)->update(['is_filter' => '0', 'filter_type' => null]); //0=deactive
        } else {
            $update_fields = new Module_fields;
            $update_fields->where('module_id', $module_id)->update(['is_filter' => '0', 'filter_type' => null]);
        }
        if ($update_fields) {
            $module = module_fields::where('module_id', $module_id)->where('is_filter', '1')->get();
            $responsetext = ['status' => 200, 'message' => 'Filter fields updated successfully.', 'data' => $module];
        } else {
            $responsetext = ['status' => 400, 'message' => 'Failed to update filter fields!', 'data' => null];
        }

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------


    #-----------------------------------------------------------------------------------------------------------------
    #Update Filter Type Of Feilds
    public function update_filter_type(Request $request)
    {
        $data = $request->json()->all();
        $module_field = null;
        if (!empty($data['data'])) {
            foreach ($data['data'] as $filed) {
                $module_field = Module_fields::find($filed['id']);
                if ($module_field) {
                    $module_field->filter_type = $filed['filter_type'] ?? null;
                    $module_field->save();
                }
            }
        }


        if ($module_field)
            $responsetext = ['status' => 200, 'message' => 'Module fields filter type updated successfully.'];
        else
            $responsetext = ['status' => 500, 'message' => 'Failed to update Filter Type!'];

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    #Delete Dynamic Module along with the Module Table
    public function destroy($id)
    {
        // Find Module Data by Module_id
        $module = Module::findOrFail(decrypt_to($id));

        if (!empty($module->table_name)) {

            $path = public_path('module_uploads/' . $module->table_name);
            if (File::exists($path))
                File::deleteDirectory($path);

            // Delete Table Form DataBase
            if (Schema::hasTable($module->table_name))
                Schema::dropIfExists($module->table_name);

            Db::table('sort_modules')
                ->where('module_id', decrypt_to($id))
                ->delete();
        }

        // Delete associated ModuleFields
        Module_fields::where('module_id', $module->id)->delete();
        $module->delete();

        $responseText = $module ? ['Status' => 200, 'message' => 'Module Deleted Successfully.'] : ['Status' => 500, 'message' => 'Failed to Delete Module.'];
        return response()->json($responseText);
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------
    #Delete Specific Fields of a Module along with Table Columns or Truncate All Fields in the Table
    public function field_del(Request $request)
    {
        $id = $request->did ?? 0;
        $module_id = $request->module_id ?? 0;

        if ($id != 0) {
            // Delete the specific module_fields where the id matches
            $field = Module_fields::find($id);
            $module = Module::find($field->module_id);


            Schema::table($module->table_name, function ($table) use ($field) {
                $table->dropColumn($field->name);
            });
            $module_del = Module_fields::where('id', $id)->delete();

            $responsetext = $module_del ? ['status' => 200, 'message' => "The field has been successfully deleted."]
                : ['status' => 400, 'message' => "The field has not been deleted."];
        } elseif ($module_id != 0) {
            // Delete the all module_feilds data where the module_id matches
            $module = Module::find($module_id);
            $field = Module_fields::where('module_id', $module_id)->get();

            Schema::table($module->table_name, function ($table) use ($field) {
                foreach ($field as $f) {
                    $table->dropColumn($f->name);
                }
            });
            DB::statement('TRUNCATE TABLE ' . $module->table_name);

            $module_del = Module_fields::where('module_id', $module_id)->delete();
            $responsetext = $module_del ? ['status' => 200, 'message' => "All fields and the data for this module have been deleted successfully."]
                : ['status' => 400, 'message' => "The fields has not been deleted."];
            ;
        } else {
            $responsetext = ['status' => 200, 'message' => 'The field has been successfully deleted.'];
        }

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------
    #-----------------------------------------------------------------------------------------------------------------

    public function getTablesColumns(Request $request)
    {
        $table_name = $request->table_name ?? null;
        $type = $request->type ?? 'tables';

        if (is_null($table_name) && $type == 'tables') {

            $excluded = ['administrators', 'role_has_permissions', 'personal_access_tokens', 'permissions', 'password_resets', 'nex_settings', 'module_fields', 'module', 'model_has_roles', 'model_has_permissions', 'migrations', 'failed_jobs', 'coupons', 'sidebar', 'roles', 'summary_boxes', 'sort_modules'];

            $key = 'Tables_in_' . env('DB_DATABASE');

            $tables = DB::select('SHOW TABLES');
            $filteredTables = array_filter(
                array_column($tables, $key),
                fn($table) => !in_array($table, $excluded)
            );

            $responsetext = $filteredTables ? ['status' => 200, 'message' => 'Tables retrieved successfully.', 'type' => $type, 'data' => $filteredTables] : ['status' => 500, 'message' => 'Tables not found.', 'type' => null, 'data' => null];
        } else if (!is_null($table_name) && $type == 'columns') {
            $columns = Schema::getColumnListing($table_name);

            $responsetext = $columns ? ['status' => 200, 'message' => 'Table columns retrieved successfully.', 'type' => $type, 'data' => $columns] :
                ['status' => 500, 'message' => 'Coulumns not found.', 'type' => null, 'data' => null];
        } else
            $responsetext = ['status' => 500, 'message' => 'Tables not found.', 'type' => null, 'data' => null];

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------

    #-----------------------------------------------------------------------------------------------------------------
    #Duplicate Module Function
    public function module_duplicate(Request $request)
    {
        $module_id = decrypt_to($request->module_id);

        $main_module = Module::with('fields')->findOrFail($module_id);
        $main_fields = $main_module->fields;

        if (!$main_module)
            return response()->json(
                ['Status' => 400, 'code' => 404, 'Message' => 'Module Not Found', 'Data' => []]
            );

        $copy_module = Module::Create(
            [
                'table_name' => null,
                'module_name' => $main_module->module_name . '_copy',
                'module_slug' => $main_module->module_slug . '_copy',
                'form_type' => $main_module->form_type
            ]
        );


        if ($copy_module && $main_fields->isNotEmpty()) {

            foreach ($main_fields as $fieldsvalue) {

                $module_fields = Module_fields::Create(
                    [
                        'module_id' => $copy_module->id,
                        'name' => $fieldsvalue->name,
                        'title' => $fieldsvalue->title,
                        'file_types' => $fieldsvalue->file_types,
                        'fields' => $fieldsvalue->fields,
                        'placeholder' => $fieldsvalue->placeholder,
                        'default_val' => $fieldsvalue->default_val,
                        'required' => $fieldsvalue->required,
                        'options' => $fieldsvalue->options,
                        'form_sort' => $fieldsvalue->form_sort,
                        'is_relational' => $fieldsvalue->is_relational,
                        'relational_table' => $fieldsvalue->relational_table,
                        'relational_table_label_field' => $fieldsvalue->relational_table_label_field,
                        'relational_table_value_field' => $fieldsvalue->relational_table_value_field,
                    ]
                );
            }

            $responsetext = $module_fields ? ['status' => 200, 'message' => 'Duplicate module created successfully.'] :
                ['status' => 400, 'message' => 'Failed to duplicate module.'];
        } else {
            $responsetext = $copy_module ? ['status' => 200, 'message' => 'Duplicate module created successfully.']
                : ['status' => 400, 'message' => 'Failed to duplicate module.'];
        }

        return response()->json($responsetext);
    }
    #-----------------------------------------------------------------------------------------------------------------

    #=================================================================================================================
    #=================================End Dynamic Module Functions====================================================
    #=================================================================================================================


    ##++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    ##++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


    #=================================================================================================================
    #================================= Dynamic Module CRUD Functions =================================================
    #=================================================================================================================




    // Show Demo Model Form
    public function modal_form(Request $request)
    {

        $module_id = $request->module_id;
        $data_id = $request->id;

        $module = Module::with('fields')->find($module_id);

        if (!$module)
            return response()->json(['status' => 404, 'message' => 'Module Not Found', 'data' => null]);


        $FormData = $this->ArrayFun($module, $data_id);

        return response()->json(['status' => 200, 'message' => 'Module Found succesfully..', 'data' => $FormData]);
    }

    public function view_onepage_form($slug, $data_id = 0)
    {
        $module = Module::where('module_slug', $slug)
            ->where('action_add', '1')
            ->where('form_type', 'form')
            ->first();
        if (!$module)
            abort(404);

        $permission = $data_id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.' . $permission)) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        $viewurl = !empty($slug) ? route('show.datatable', $slug) : "javascript:void(0)";
        $file['breadcrumbs'] = [
            ['link' => $viewurl, 'name' => ucwords($module['module_name'])],
            ['name' => 'form'],
        ];
        return view("module.module_form", ['slug' => $slug, 'data_id' => $data_id], $file);
    }

    public function onepage_form(Request $request)
    {
        $data_id = $request->data_id;



        $module = Module::with('fields')->where('module_slug', $request->module_slug)->first();
        if (!$module) {
            return response()->json(['status' => 404, 'message' => 'Module Not Found', 'data' => null]);
        }

        $permission = $data_id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.' . $permission)) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }

        $FormData = $this->ArrayFun($module, $data_id);
        return response()->json(['status' => 200, 'message' => 'Module Found succesfully..', 'data' => $FormData]);
    }

    // Create Array Of Module Data
    public function ArrayFun($module, $data_id)
    {

        $fields_data = [];
        if ($data_id > 0) {
            // For fetch particular Table Data
            $fields = $module->fields->sortBy('form_sort');

            $data = Db::table($module->table_name)->where('id', $data_id)->first();
            $fields_data = [];

            $fields_data['id'] = $data->id ?? null;
            foreach ($fields as $field) {
                $fields_data[$field->name] = $data->{$field->name} ?? "";
            }
        }
        // ------------------

        // Create Associative for helper function
        $formArray = [
            'module_id' => $module->id,
            'table_name' => $module->table_name,
            'module_name' => $module->module_name,
            'module_slug' => $module->module_slug,
            'update' => $module->action_update,
            'delete' => $module->action_delete,
            'status' => $module->action_status,
            'fieldData' => [],
        ];

        // create array of *****fields Table**** Data
        if ($module && $module->fields) {

            // dd($module->fields);
            foreach ($module->fields as $field) {

                // Basic structure for each field
                $fieldData = [
                    'id' => $field->id ?? '',
                    'title' => $field->title ?? 'default',
                    'fields' => $field->fields ?? 'text',
                    'name' => $field->name ?? '',
                    'placeholder' => $field->placeholder ?? '',
                    'default_value' => $field->default_val ?? '',
                    'form_sort' => $field->form_sort,
                    'layout_class' => $field->layout_class ?? 'col-md-12',
                    'file_type' => !is_null($field->file_types) ? implode(',', json_decode($field->file_types)) : null,
                    'required' => $field->required ?? '',
                    'repeater_fields' => !is_null($field->repeater_fields) ? json_decode($field->repeater_fields) : null,
                ];

                $data = json_decode($field->options);

                // For radio, checkbox, or select
                if (in_array($field->fields, ['radio', 'checkbox', 'select', 'multiple_select', 'badge'])) {


                    if (in_array($field->fields, ['select', 'multiple_select']) && $field->is_relational == "1") {
                        $relational_data = DB::table($field->relational_table)->select($field->relational_table_label_field, $field->relational_table_value_field)->get();

                        $fieldData['data'] = $relational_data->map(function ($relational_data) use ($field) {
                            return [
                                'label' => ucfirst($relational_data->{$field->relational_table_label_field}),
                                'value' => strtolower($relational_data->{$field->relational_table_value_field}),
                            ];
                        })->toArray();
                    } else {
                        if (!empty($data)) {
                            $color_data = $field->fields === "badge" ? json_decode($field->badge_color) : [];
                            $fieldData['data'] = array_map(function ($option, $index) use ($field, $color_data) {
                                return [
                                    'label' => ucfirst($option),
                                    'value' => strtolower($option),
                                    'bg_color' => ($field->fields === "badge" && isset($color_data[$index])) ? $color_data[$index] : '',
                                ];
                            }, $data, array_keys($data));
                        }
                    }
                }



                $formfields[] = $fieldData; //fieldData store in FormData for sorting
            }
        }


        // Sort the array based on position
        usort($formfields, function ($a, $b) {
            return $a['form_sort'] <=> $b['form_sort'];
        });

        $formArray['fieldData'] = $formfields;

        // FormArray pass in helper function for create dynamic form
        $FormData = createHtmlForm($formArray, $fields_data);

        return $FormData;
    }
    #---------------------------------------------------------------------------------------------


    #---------------------------------------------------------------------------------------------
    #Dynamic Module Crud Start Here....
    public function module_DataTable(Request $request, $slug)
    {
        $authuser = Auth::user();

        if ($request->ajax()) {
            $module = Module::where('module_slug', $slug)->where('module_status', 'active')->first();


            if ($authuser->hasRole(['staff']) && !$authuser->can($authuser->staff_role_id . '.' . $module->module_slug . '.read')) {
                return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
            }


            if (!$module)
                return response()->json(['status' => 404, 'message' => 'Module Not Found', 'data' => null]);

            $filter_fields = $module->fields->where('is_filter', '1');
            $fields = $module->fields->where('table_status', '1')->sortBy('table_sort');


            $date_names = $fields
                ->whereIn('fields', ['date', 'time', 'datetime-local'])
                ->pluck('name')
                ->toArray();

            $isModel = $module->form_type == 'model';

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




            $columns = $fields->pluck('name')->toArray();
            $bthead = $fields->pluck('title')->toArray();

            $columns = [...$columns, 'id', 'status', 'updated_at'];


            $col = [...$columns];
            $sortBy = $request->sort ? $request->sort : "id";
            $sortDirection = $request->direction ? $request->direction : "desc";



            $Data = db::table($module->table_name)
                ->select($columns)
                ->orderBy($sortBy, $sortDirection);

            $limit = $request->limit ? $request->limit : 10;

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request, $columns) {
                    foreach ($columns as $column) {
                        $query->orWhere($column, 'LIKE', '%' . $request->search . "%");
                    }
                });
            }



            if (!empty($filter_fields)) {
                foreach ($filter_fields as $key => $value) {

                    $field = $value->filter_type . '_' . $value->name;
                    $start_val = 'start_' . $value->filter_type . '_' . $value->name;
                    $end_val = 'end_' . $value->filter_type . '_' . $value->name;

                    if (!empty($request->{$field}) || !empty($request->{$start_val}) || !empty($request->{$end_val})) {
                        $filterValue = $request->{$field};

                        if (in_array($value->filter_type, ['date', 'time', 'datetime'])) {
                            if ($value->filter_type == 'date') {
                                $dateRange = explode(' to ', $filterValue);

                                (count($dateRange) == 2)
                                    ? $Data->whereBetween($value->name, array_map('trim', $dateRange))
                                    : $Data->whereDate($value->name, trim($filterValue));
                            } else {
                                $Data->whereBetween($value->name, [$request->{$start_val}, $request->{$end_val}]);
                            }
                        } else if (in_array($value->fields, ['checkbox', 'multiple_select'])) {
                            // If the filter value is an array, use whereJsonContains
                            if (is_array($filterValue)) {
                                $Data->whereJsonContains($value->name, $filterValue);
                            } else {
                                // For simple string values inside JSON, use whereRaw (MySQL/MariaDB support needed)
                                $Data->whereRaw("JSON_CONTAINS(`{$value->name}`, '\"{$filterValue}\"')");
                            }
                        } else if (!empty($request->{$field})) {
                            $Data->where($value->name, $filterValue);
                        }
                    }
                }
            }


            $thead = [];

            $thead[] = [
                'title' => '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'col' => "checkbox",
                'is_sort' => false,
            ];
            $thead[] = [
                'title' => "Action",
                'col' => "Action",
                'is_sort' => false,
            ];

            $hasActions = false;
            $blukactions = false;

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

            $tbody = $Data->paginate($limit);
            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $row) {


                $buttons = $module->action_update == '1' && !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.edit')) ? '<a href="' . (!$isModel
                    ? route('view.module_OnepageForm', [$module->module_slug, $row->id])
                    : 'javascript:void(0);') . '" class="avatar avatar-status bg-light-primary ' . ($isModel ? "table_edit_data" : "") . '  " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"  data-mid="' . $module->id . '"  data-did="' . $row->id . '">
                <span class="avatar-content">
                    <i data-feather=\'edit\' class="avatar-icon"></i>
                </span>
                </a>' : '';



                $buttons .= $module->action_view == '1' && !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.view')) ? '
                <a href="javascript:void(0);" class="avatar avatar-status bg-light-info view_btn " data-bs-toggle="tooltip" data-bs-placement="bottom" title="View" data-mid="' . $module->id . '"  data-did="' . $row->id . '" >
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'eye\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $buttons .= $module->action_delete == '1' && !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.delete')) ? '
                <a href="javascript:void(0);" class="avatar avatar-status bg-light-danger  delete_record " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"  deleteto="' . 'table_data/' . $module->table_name . '/' . encrypt_to(value: $row->id) . '" >
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $buttons .= $module->action_status == '1' && !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.status')) ? '
                    <div class="datatable-switch form-check form-switch form-check-primary1 d-inline-block align-middle "  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($row->status == 'active' ? 'Deactivate' : 'Activate') . '">
                        <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($row->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to($module->table_name) . '/' . encrypt_to($row->id) . '/' . encrypt_to('status') . '" />
                    <label class="form-check-label" for="StatusSwitch' . $key . '">
                        <span class="switch-icon-left new-icon-x"><i data-feather="check"></i></span>
                        <span class="switch-icon-right new-icon-x"><i data-feather="x"></i></span>
                    </label>
                </div>' : '';


                $hasActions = empty($buttons);

                $blukactions = !(
                    (Auth::user()->hasRole('staff') && (
                        ($module->action_delete == '1' && Auth::user()->can($authuser->staff_role_id . '.' . $module->module_slug . '.delete')) ||

                        ($module->action_status == '1' && Auth::user()->can($authuser->staff_role_id . '.' . $module->module_slug . '.status')) ||

                        ($module->action_delete == '0' && !Auth::user()->can($authuser->staff_role_id . '.' . $module->module_slug . '.delete')) ||

                        ($module->action_status == '0' && !Auth::user()->can($authuser->staff_role_id . '.' . $module->module_slug . '.status'))

                    ) && ($module->action_delete == '1' || $module->action_status == '1'))
                    ||
                    (!Auth::user()->hasRole('staff') && ($module->action_delete == '1' || $module->action_status == '1'))
                );


                $row_id = $row->id;
                $tablename = $module->table_name;

                $row = (array) $row;
                foreach ($row as $rowkey => $rowval) {


                    $ValueArr = json_decode($rowval, true);

                    // dd($rowkey);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && is_string($ValueArr[0]) && !empty($ValueArr) && str_starts_with($ValueArr[0], 'module_uploads/' . $module->table_name . '')) {

                        $img_path = asset((!empty($ValueArr[0]) && file_exists(public_path($ValueArr[0]))) ? $ValueArr[0] : "module_uploads/no_image.jpg");

                        $countdiv = count($ValueArr) > 1 ? '<span class="preview_btn " data-tablename="' . $tablename . '" data-columnname="' . $rowkey . '" data-id="' . $row_id . '">+' . count($ValueArr) - 1 . '</span>' : '';

                        $row[$rowkey] = '<div style="position:relative;" class="dataTable_image_preview"><a href="' . $img_path . '" data-lightbox="' . ($rowkey . $row_id) . '" data-title="' . $rowkey . ' preview" class="show_img_a"><img src="' . $img_path . '" class="rounded show_img" alt="Image" /></a>' . $countdiv . "</div>";
                    } else {
                        if (in_array($rowkey, $ralational_names) && !empty($rowval)) {
                            $matchingData = [];

                            $matchingData = array_filter($relational_data, function ($data) use ($rowkey) {
                                return $data['name'] === $rowkey;
                            });
                            $matchingData = reset($matchingData);

                            // Access other relational data fields
                            $relational_table = $matchingData['relational_table'];
                            $label_field = $matchingData['relational_table_label_field'];
                            $value_field = $matchingData['relational_table_value_field'];

                            $acticon = in_array($matchingData['field_type'], ['select', 'radio']) ? 'first' : 'get';
                            $condition = in_array($matchingData['field_type'], ['select', 'radio']) ? 'where' : 'whereIn';
                            $rowval = in_array($matchingData['field_type'], ['select', 'radio']) ? $rowval : json_decode($rowval);


                            $table_data = DB::table($relational_table)->select($label_field)->{$condition}($value_field, $rowval)->{$acticon}();


                            $row[$rowkey] = !empty($table_data) ? ($acticon == "get" ? implode(',', $table_data->pluck($label_field)->toArray()) : $table_data->{$label_field}) : '--';
                        } else if (in_array($rowkey, $badge_names) && !empty($rowval)) {
                            $matchBadge = [];

                            $matchBadge = array_filter($badge_data, function ($data) use ($rowkey) {
                                return $data['name'] === $rowkey;
                            });

                            $matchBadge = reset($matchBadge);
                            $bg_color = ($index = array_search($rowval, $matchBadge['options'])) !== false
                                ? $matchBadge['badge_color'][$index] ?? '#000000'
                                : '#000000';
                            $row[$rowkey] = '<span class="badge rounded" style="background-color:' . $bg_color . '; opacity: 1;">' . $rowval . '</span>';
                        } else if (in_array($rowkey, ['updated_at', ...$date_names]) && !empty($rowval)) {
                            try {
                                $isDateOnly = preg_match('/^\d{4}-\d{2}-\d{2}$/', $rowval);
                                $isTimeOnly = preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $rowval);

                                if ($isTimeOnly) {
                                    $row[$rowkey] = date('h:i A', strtotime($rowval));
                                } else {
                                    $d = new DateTime($rowval);
                                    $row[$rowkey] = $d->format($isDateOnly ? 'd-m-Y' : 'd-m-Y h:i A');
                                }
                            } catch (Exception $e) {
                                $row[$rowkey] = $rowval;
                            }
                        } else
                            $row[$rowkey] = !empty($rowval)
                                ? (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && is_string($ValueArr[0]) && !empty($ValueArr)
                                    ? implode(',', $ValueArr)
                                    : (str_word_count($rowval) > 6 // Check if the value has more than 15 words
                                        ? implode(' ', array_slice(explode(' ', $rowval), 0, 6)) . '...' // Show first 6 words with "..."
                                        : $rowval)) // Otherwise, show the original value
                                : '--';
                    }
                }

                $all_delete = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $row_id . '" >';

                // $tbody_data[$key] = [$all_delete, $buttons, ...(array) $row];
                $tbody_data[$key] = !empty($buttons) ? ($blukactions ? [$buttons, ...(array) $row] : [$all_delete, $buttons, ...(array) $row]) : [...(array) $row];

                unset($tbody_data[$key]['status']);
                unset($tbody_data[$key]['id']);
            }

            if ($blukactions) {
                unset($thead[0]);
            }
            if ($hasActions) {
                unset($thead[1]);
            }



            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatablev2', compact('tbody', 'col', 'thead', 'sortBy', 'sortDirection'))->render();
        }

        $module = Module::with('fields')
            ->where('module_slug', $slug)
            ->whereNotNull('table_name')
            ->where('module_status', 'active')
            ->firstorfail();

        $fields = $module->fields->where('is_filter', '1');

        if ($authuser->hasRole(['staff']) && !$authuser->can($authuser->staff_role_id . '.' . $module->module_slug . '.read')) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        $bulk_delete = $module->action_delete == '1' && !($authuser->hasRole('staff') && !$authuser->can($authuser->staff_role_id . '.' . $module->module_slug . '.delete'));
        $bulk_status = $module->action_status == '1' && !($authuser->hasRole('staff') && !$authuser->can($authuser->staff_role_id . '.' . $module->module_slug . '.status'));

        $FilterData = [];
        if (!empty($fields)) {
            foreach ($fields as $field) {
                $fieldData = [];
                $element_extra_classes = "";
                $type = "";

                $element_extra_classes = in_array($field->filter_type, ['select']) ? 'select2' : '';
                if (in_array($field->fields, ['radio', 'checkbox', 'select', 'multiple_select'])) {
                    $field_data = json_decode($field->options);

                    if (in_array($field->fields, ['select', 'multiple_select']) && $field->is_relational == "1") {
                        $relational_data = DB::table($field->relational_table)->select($field->relational_table_label_field, $field->relational_table_value_field)->get();

                        $fieldData = $relational_data->map(function ($relational_data) use ($field) {
                            return [
                                'label' => ucfirst($relational_data->{$field->relational_table_label_field}),
                                'value' => $relational_data->{$field->relational_table_value_field},
                            ];
                        })->toArray();
                    } else {
                        if (!empty($field_data)) {
                            $fieldData = array_map(function ($option) {
                                return [
                                    'label' => ucfirst($option),
                                    'value' => $option
                                ];
                            }, $field_data);
                        }
                    }

                    $type = in_array($field->filter_type, ['radio', 'checkbox']) ? $field->filter_type : '';
                } else if (in_array($field->fields, ['date', 'time', 'datetime-local'])) {

                    $fieldData = [];
                    $element_extra_classes = $field->fields == 'date' ? "flatpickr-range flatpickr-input" : ($field->fields == 'time' ? "flatpickr-time text-start" : "flatpickr-date-time");
                    $type = $field->fields == 'date' ? "date" : ($field->fields == 'time' ? "time" : "datetime-local");
                } else {
                    $table_data = DB::table($module->table_name)
                        ->select($field->name)
                        ->distinct()
                        ->get();
                    $fieldData = $table_data->map(function ($table_data) use ($field) {
                        return [
                            'label' => ucfirst($table_data->{$field->name}),
                            'value' => $table_data->{$field->name},
                        ];
                    })->toArray();
                }


                $commonData = [
                    'tag' => in_array($field->filter_type, ['select', 'multiple_select']) ? 'select' : 'input',
                    'roles' => [],
                    'type' => $type,
                    'validation' => '',
                    'grid' => 12,
                    'data' => $fieldData,
                    'outer_div_classes' => 'mb-0',
                    'element_extra_classes' => $element_extra_classes,
                    'element_extra_attributes' => ''
                ];

                if (in_array($field->filter_type, ['time', 'datetime'])) {
                    $FilterData[] = array_merge($commonData, [
                        'label' => 'start ' . $field->title,
                        'name' => 'start_' . $field->filter_type . '_' . $field->name
                    ]);
                    $FilterData[] = array_merge($commonData, [
                        'label' => 'end ' . $field->title,
                        'name' => 'end_' . $field->filter_type . '_' . $field->name
                    ]);
                } else {
                    $FilterData[] = array_merge($commonData, [
                        'label' => $field->title,
                        'name' => $field->filter_type . '_' . $field->name
                    ]);
                }
            }
            if (!empty($FilterData)) {
                $FilterData[] = [
                    'tag' => 'input',
                    'roles' => [],
                    'type' => 'reset',
                    'label' => "",
                    'name' => "reset",
                    'validation' => '',
                    'value' => 'Reset Filter',
                    'grid' => 12,
                    'data' => [],
                    'outer_div_classes' => 'mb-0',
                    'element_extra_classes' => 'btn btn-outline-danger mt-2',
                    'element_extra_attributes' => ''
                ];
            }
        }

        $moduleListFormData = [
            'name' => 'module-datatable-form',
            'action' => route('show.datatable', [$slug]),
            'bulk_action_url' => "module/" . encrypt_to($module->table_name),
            'bulk_delete' => $bulk_delete,
            'bulk_status' => $bulk_status,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' =>
                $FilterData
        ];

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],
            ['name' => ucwords($module['module_name'])],
        ];
        $file['title'] = ucwords($module['module_name']);

        return view('module.module_datatable', compact('module', 'moduleListFormData'), $file);
    }
    #---------------------------------------------------------------------------------------------
    #---------------------------------------------------------------------------------------------
    #Dynamic Module Crud Start Here....

    #--------------------------------------------------------------------------------------------------------
    # function for store module data(Dynamic Moduel Data)
    public function store_module(Request $request)
    {

        $data = $request->all();

        $table_name = $data['table_name'];
        unset($data['table_name']);
        $id = $data['id'];
        unset($data['id']);
        $data_slug = null;


        $dynamic_module = Module::with(
            'fields'
        )->where('table_name', $table_name)->first();


        $permission = $id > 0 ? 'edit' : 'create';
        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $dynamic_module->module_slug . '.' . $permission)) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }

        $rules = [];
        // create rules for validation(from module required fields..)
        foreach ($dynamic_module->fields as $field) {

            if ($field->required == '1') {
                if ($field->fields == 'email') {
                    $rules[$field->name] = 'required|email';
                } else if (in_array($field->fields, ['single_file', 'multiple_file'])) {

                    $fileRule = $id == 0 || $id == null ? 'required|' : '';
                    $fileTypes = implode(',', json_decode($field->file_types));

                    $field_name = $field->fields == 'single_file' ? "{$field->name}" : "{$field->name}.*";
                    if ($field->fields == 'multiple_file') {
                        $rules[$field->name] = "{$fileRule}|array";
                    }
                    $rules[$field_name] = "{$fileRule}file|mimetypes:{$fileTypes}";
                } else if (in_array($field->fields, ['repeater'])) {
                    $rules[$field->name . ".*"] = 'required';
                } else {
                    $rules[$field->name] = 'required';
                }
            }

            if ($field->is_slug == 1) {
                $data_value = request($field->name);
                $data_slug = Str::slug($data_value);
                $rules[$field->name] = 'required';
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $original_slug = $data_slug;

        if (!empty($data_slug) && DB::table($table_name)->where('slug', $data_slug)->where('id', '!=', $id)->exists()) {
            do {
                $random_string = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 4);
                $data_slug = $original_slug . '-' . $random_string;
            } while (DB::table($table_name)->where('slug', $data_slug)->exists());
        }


        $InsertOrUpdate = [];

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {

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
            } else
                // if not file then store data in table and in array store in json form
                $InsertOrUpdate[$key] = is_array($value) ? json_encode($value) : ($value ?? null);
        }

        // id grether than 0 then update data otherwise insert data
        if ($id > 0) {
            // for update data
            $InsertOrUpdate['updated_at'] = now();
            $upadted = DB::table($table_name)->where('id', $id)->update($InsertOrUpdate);

            $responseData = $upadted
                ? ['status' => 200, 'message' => 'Record updated successfully.']
                : ['status' => 500, 'message' => 'Record could not be updated.'];
        } else {
            // for insert data
            $InsertOrUpdate['status'] = 'active';
            $InsertOrUpdate['slug'] = $data_slug ?? null;
            $InsertOrUpdate['created_at'] = now();
            $InsertOrUpdate['updated_at'] = now();
            $inserted = DB::table($table_name)->insert($InsertOrUpdate);

            $responseData = $inserted
                ? ['status' => 200, 'message' => 'Record saved successfully.']
                : ['status' => 500, 'message' => 'Record could not be saved.'];
        }
        return response()->json($responseData);
    }
    #--------------------------------------------------------------------------------------------------------



    #-------------------------------------------------------------------------------------------------------
    #Destroy Dynamic Create Module Records Data
    public function destroy_data($tablename, $id)
    {
        $id = decrypt_to($id);
        $dynamic_module = Module::with([
            'fields' => function ($query) {
                $query->whereIn('fields', ['multiple_file', 'single_file']);
            }
        ])->where('table_name', $tablename)->first();



        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $dynamic_module->module_slug . '.delete')) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }

        if ($dynamic_module) {
            foreach ($dynamic_module->fields as $value) {
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
        }

        $module = Db::table($tablename)->where('id', $id)->delete();

        $responseData = $module
            ? ['Status' => 200, 'message' => 'Data Delete succesfully']
            : ['Status' => 404, 'message' => 'Data does not Delete'];
        return response()->json($responseData);
    }
    #-------------------------------------------------------------------------------------------------------


    #-------------------------------------------------------------------------------------------------------
    #Delete Module Image from Table and Folder
    public function destory_image(Request $request)
    {

        $tablename = $request->input('tablename');
        $id = $request->input('id', '0');
        $img_name = $request->input('img_name');
        $field_name = $request->input('field_name');

        $module_table = Db::table($tablename)->select($field_name)->where('id', $id)->first();

        $images = json_decode($module_table->$field_name);
        $key = array_search($img_name, $images);
        if ($key !== false) {
            unset($images[$key]);
        }

        $filePath = public_path($img_name);

        if (File::exists($filePath))
            File::delete($filePath);


        $images = !empty(array_values($images)) ? json_encode(array_values($images)) : null;

        $module_update = Db::table($tablename)->where('id', $id)->update([$field_name => $images]);

        $responseData = $module_update
            ? ['status' => 200, 'message' => 'Image deleted successfully.']
            : ['status' => 404, 'message' => 'Image could not be deleted.'];

        return response()->json($responseData);
    }
    #-------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------
    #Image Preview Function
    public function img_preview(Request $request)
    {
        $id = $request->id;
        $tablename = $request->tablename;
        $columnname = $request->column_name;

        $module_images = DB::table($tablename)
            ->select($columnname)
            ->where('id', $id)
            ->first();

        if ($module_images) {

            $field_data = json_decode($module_images->$columnname);
            $data = collect($field_data)->map(function ($image) {
                // $img_path = asset((!empty($image) && file_exists(public_path($image))) ? $image : "module_uploads/no_image.jpg");
                // return [
                //     'img_name' => $image,
                //     'url' => $img_path
                // ];
                $defaultImage = "module_uploads/no_image.jpg";
                $img_path = asset((!empty($image) && file_exists(public_path($image))) ? $image : $defaultImage);

                return [
                    'img_name' => $image,
                    'url' => $img_path
                ];
            })
                ->toArray();
        }

        $responseData = $module_images
            ? ['status' => 200, 'message' => 'Image successfully Found.', 'data' => $data]
            : ['status' => 400, 'message' => 'Images could not be found.', 'data' => []];

        return response()->json($responseData);
    }
    #-------------------------------------------------------------------------------------------------------


    #-------------------------------------------------------------------------------------------------------
    #Single Data View(Details)
    public function record_view(Request $request)
    {

        $module_id = $request->module_id;
        $data_id = $request->id;

        $module = Module::with('fields')->find($module_id);

        if (!$module || $data_id == 0)
            return response()->json([
                'status' => 404,
                'message' => 'No matching data found.',
                'data' => null
            ]);

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.view')) {
            return response()->json(['status' => 403, 'message' => UNAUTH_403_MESSAGE]);
        }


        $data = Db::table($module->table_name)->where('id', $data_id)->first();
        $fields_data = [];
        if ($data) {
            $tablename = $module->table_name;
            $fields = $module->fields->sortBy('form_sort');

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

            $date_names = $module->fields
                ->whereIn('fields', ['date', 'time', 'datetime-local'])
                ->pluck('name')
                ->toArray();

            $row_id = $data->id ?? null;
            foreach ($fields as $field) {

                $rowkey = $field->name;
                $rowval = $data->{$field->name};

                $ValueArr = json_decode($rowval, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && !empty($ValueArr) && str_starts_with($ValueArr[0], 'module_uploads/' . $module->table_name . '')) {

                    $img_path = asset((!empty($ValueArr[0]) && file_exists(public_path($ValueArr[0]))) ? $ValueArr[0] : "module_uploads/no_image.jpg");

                    $countdiv = count($ValueArr) > 1 ? '' : '';


                    // $record_val =
                    //     '<div style="position:relative;">
                    //             <a href="' . $img_path . '" data-lightbox="' . ($rowkey . $row_id) . '" data-title="' . $rowkey . ' preview" class="show_img_a"><img src="' . $img_path . '" class="rounded show_img" alt="Image" /></a>
                    //     </div>';
                    $img_src = $ValueArr;
                    $img_preview = null;
                    if (!empty($img_src)) { {

                            $img_preview .= "<div class=' overflow-auto d-flex flex-row flex-wrap' style='max-height:128px; '>";
                            foreach ($img_src as $img) {
                                // $img_preview .= '<div  class="my-1 image-container" style="position: relative;">';

                                $path = asset(!empty($img) && file_exists(public_path($img)) ? $img : "module_uploads/no_image.jpg");
                                $img_preview .= '<img src="' . $path . '" alt="' . $path . '" class="rounded show_img ms-1 mb-1"  />';

                                // $img_preview .= '</div>';
                            }
                            $img_preview .= "</div>";
                        }
                    }
                    $record_val = $img_preview;
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

                        $acticon = in_array($matchingData['field_type'], ['select', 'radio']) ? 'first' : 'get';
                        $condition = in_array($matchingData['field_type'], ['select', 'radio']) ? 'where' : 'whereIn';
                        $rowval = in_array($matchingData['field_type'], ['select', 'radio']) ? $rowval : json_decode($rowval);


                        $table_data = DB::table($relational_table)->select($label_field)->{$condition}($value_field, $rowval)->{$acticon}();

                        $record_val = !empty($table_data) ? ($acticon == "get" ? implode(',', $table_data->pluck($label_field)->toArray()) : $table_data->{$label_field}) : '--';
                    } else if (in_array($rowkey, ['updated_at', ...$date_names]) && !empty($rowval)) {
                        try {
                            $isDateOnly = preg_match('/^\d{4}-\d{2}-\d{2}$/', $rowval);
                            $isTimeOnly = preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $rowval);

                            if ($isTimeOnly) {
                                $record_val = date('h:i A', strtotime($rowval));
                            } else {
                                $d = new DateTime($rowval);
                                $record_val = $d->format($isDateOnly ? 'd-m-Y' : 'd-m-Y h:i A');
                            }
                        } catch (Exception $e) {
                            $record_val = $rowval;
                        }
                    } else
                        $record_val = !empty($rowval)
                            ? (json_last_error() === JSON_ERROR_NONE && is_array($ValueArr) && !empty($ValueArr)
                                ? implode(',', $ValueArr)
                                : $rowval)
                            : '--';
                }

                $fields_data[] = [
                    'title' => $field->title ?? "",
                    'value' => $record_val,
                    // 'field_type' => $field->fields ?? "",
                ];
            }
            $fields_data[] = [
                'title' => "Update Date",
                'value' => $data->updated_at,
            ];
            $response = ['status' => 200, 'message' => 'Record Found succesfully.', 'data' => $fields_data];
        } else {
            $response = ['status' => 400, 'message' => 'Record Not Found', 'data' => []];
        }

        return response()->json($response);
    }
    #-------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------
    #bulk Actions for Dynamic Module
    public function bulkAction(Request $request)
    {
        if (!$request->route('table_name'))
            return faildResponse(['Message' => 'Provided All Information!']);

        $table = decrypt_to(urlencode($request->route('table_name')));

        $ids = $request->input('ids');
        $action = $request->input('action');


        if (!Schema::hasTable($table))
            return faildResponse(['Message' => 'Invalid Table!']);

        $affected = DB::table($table)
            ->whereIN('id', $ids);

        if ($action == "delete") {
            $dynamic_module = Module::with([
                'fields' => function ($query) {
                    $query->whereIn('fields', ['multiple_file', 'single_file']);
                }
            ])->where('table_name', $table)->first();

            if ($dynamic_module) {
                foreach ($dynamic_module->fields as $value) {
                    $field_name = $value->name;
                    $module_tables = Db::table($table)->select($field_name)->whereIn('id', $ids)->get();

                    foreach ($module_tables as $row) {
                        if (!empty($row->$field_name)) {
                            $images = json_decode($row->$field_name, true); // Decode as array

                            if (is_array($images)) {
                                foreach ($images as $img) {
                                    $filePath = public_path($img);
                                    if (File::exists($filePath))
                                        File::delete($filePath);
                                }
                            }
                        }
                    }
                }
            }
        }

        $affected = $action == "delete" ? $affected->delete() : $affected->update(['status' => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }
    #-------------------------------------------------------------------------------------------------------

    #=================================================================================================================
    #=================================End Dynamic Module CRUD Functions ==============================================
    #=================================================================================================================


}
