<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Sidebar;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SidebarController extends Controller
{
    #====================================================================================================================================================
    #=========================================================Start Sidebar Function=====================================================================
    #====================================================================================================================================================

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #index function Sidebar
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Data = Sidebar::orderByDesc('id');

            $thead = ['Action', 'Sidebar Label', 'Parent', 'UpdateDate'];
            $nhed = [];
            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('sidebar_label', 'LIKE', '%' . $request->search . "%");
                });
            }

            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);

            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {
                $show_parent = $data->parent_id !== 0
                    ? '<a href="#" data-pid="' . $data->parent_id . '" class="sidebar_sorting">' . optional(Sidebar::find($data->parent_id))->sidebar_label . '</a>'
                    : '--';
                $tbody_data[$key] =
                    [
                        '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-sidebarModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('sidebar') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>

                    <a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . encrypt_to('sidebar') . '/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>

                    <div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('sidebar') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>',
                        $data->sidebar_label ? ($data->sidebar_icon != null ? '<i data-feather="' . $data->sidebar_icon . '"></i>&nbsp;' . $data->sidebar_label : $data->sidebar_label) : '--',
                        $show_parent,
                        $data->updated_at,
                    ];
            }
            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $parent_sidebar = Sidebar::where('parent_id', '0')
            ->where('is_dropdown', '1')
            ->orderByDesc('id')
            ->get(['id', 'sidebar_label'])
            ->map(fn($item) => ['value' => $item->id, 'label' => $item->sidebar_label])
            ->toArray();



        $module = Module::where('module_status', 'active')
            ->orderByDesc('id')
            ->get(['id', 'module_name', 'module_slug'])
            ->map(fn($item) => ['value' => $item->module_slug, 'label' => ucfirst($item->module_name)])
            ->toArray();

        $roles = Db::table('roles')
            ->orderByDesc('id')
            ->get(['id', 'name'])
            ->map(fn($item) => ['value' => $item->name, 'label' => ucfirst($item->name)])
            ->toArray();

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Sidebar list")],
        ];
        $file['title'] = ucwords("Sidebar list");


        $file['SidebarDataFilterData'] = [
            'name' => 'Sidebar',
            'action' => route('sidebar.index'),
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['SidebarFormData'] = [
            'name' => 'sidebar_form',
            'action' => route('sidebar.store'),
            'method' => 'post',
            'submit' => 'Save Sidebar',
            'btnGrid' => 3,
            'no_submit' => false,
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'id',
                    'label' => '',
                    'placeholder' => 'id',
                    'value' => '0',
                    'grid' => '1',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'sidebar_label',
                    'label' => 'Sidebar Label',
                    'placeholder' => 'Sidebar label',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'select',
                    'name' => 'sidebar_icon',
                    'label' => 'Sidebar Icon',
                    'element_extra_classes' => 'select2InModal form-control',
                    'element_extra_attributes' => '',
                    'data' => [],
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'checkbox',
                    'name' => 'is_dropdown',
                    'label' => '',
                    'element_extra_classes' => 'is_dropdown',
                    'grid' => '12',
                    'placeholder' => '',
                    'value' => '',
                    'data' => [
                        ['value' => '1', 'label' => 'Enable Dropdown Mode'],
                    ],
                ],
                [
                    'tag' => 'input',
                    'type' => 'radio',
                    'name' => 'link_type',
                    'label' => '',
                    'element_extra_classes' => 'link_type',
                    'outer_div_classes' => 'link_type_div',
                    'grid' => '12',
                    'placeholder' => '',
                    'value' => 'internal_route',
                    'data' => [
                        ['value' => 'internal_route', 'label' => 'Internal Route'],
                        ['value' => 'external_link', 'label' => 'External Link'],
                        ['value' => 'dynamic_module', 'label' => 'Dynamic Module'],
                    ],
                ],
                [
                    'tag' => 'select',
                    'name' => 'module_name',
                    'label' => 'Dynamic Module Name',
                    'element_extra_classes' => 'select2InModal',
                    'element_extra_attributes' => '',
                    'outer_div_classes' => 'module_div',
                    'data' => $module,
                    'grid' => '12',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'sidebar_link',
                    'label' => 'Sidebar Link',
                    'placeholder' => 'Sidebar Link',
                    'outer_div_classes' => 'sidebar_link_div',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'sidebar_link_attribute',
                    'label' => 'Sidebar Link Attribute',
                    'outer_div_classes' => 'sidebar_link_attribute_div',
                    'placeholder' => 'Sidebar Link Attribute',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'permissions_slug',
                    'label' => 'Permissions Slug',
                    'outer_div_classes' => 'permissions_slug_div',
                    'placeholder' => 'Permissions Slug',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'select2',
                    'name' => 'sidebar_roles',
                    'label' => 'Roles',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => 'multiple',
                    'data' => $roles,
                    'grid' => '6',
                ],
                [
                    'tag' => 'select',
                    'name' => 'parent_id',
                    'label' => 'Parent Sidebar',
                    'element_extra_classes' => 'select2InModal form-control',
                    'data' => $parent_sidebar,
                    'grid' => '6',
                ]
            ],
        ];

        return view('sidebar.index', $file);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Store Sidebar Data
    public function store(Request $request)
    {

        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'sidebar_label' => 'required|unique:sidebar,sidebar_label,' . $id,
            'sidebar_roles' => 'required|array|min:1',
            'sidebar_icon' => 'required|min:1',
            // 'link_type' => 'required_unless:is_dropdown,1',
            'link_type' => Rule::requiredIf(!in_array('1', (array) $request->input('is_dropdown'))),
            'module_name' => 'required_if:link_type,dynamic_module',
            'sidebar_link' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->has('is_dropdown'))
                        return;

                    $linkType = $request->input('link_type');
                    $sidebarLinkAttribute = $request->input('sidebar_link_attribute', null);

                    if ($linkType === 'internal_route') {
                        if (empty($value)) {
                            $fail(__('The :attribute field is required.', ['attribute' => $attribute]));
                        } else {
                            $routeParams = !empty($sidebarLinkAttribute) ? $sidebarLinkAttribute : null;
                            // dd($routeParams);
                            if (!Route::has($value)) {
                                $fail(__('The :attribute must be a valid route name.', ['attribute' => $attribute]));
                            } else {
                                try {
                                    // Decode the route parameters
                                    $params = explode(" ", $routeParams);


                                    // Check if the route exists with the given parameters
                                    $url = route($value, $params);


                                    // If no URL is generated, that means the parameters are invalid for the route
                                    if (!$url) {
                                        $fail(__('The :attribute is invalid with the provided parameters.', ['attribute' => $attribute]));
                                    }
                                } catch (\Exception $e) {
                                    // Catch any exceptions that occur (e.g., invalid parameters)
                                    $fail(__('The :attribute is invalid with the provided parameters.', ['attribute' => $attribute]));
                                }
                            }
                        }
                    }
                    // Validation for 'external_link'
                    elseif ($linkType === 'external_link' && empty($value)) {
                        $fail(__('The :attribute field is required.', ['attribute' => $attribute]));
                    }
                }
            ],

        ], [
            'link_type.required_unless' => 'The link type field is required.',
            'module_name.required_if' => 'The module name is required.'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $roles = $request->input('sidebar_roles', null);
        $roles = !empty($roles) ? json_encode($roles) : [null];


        // $is_dropdown = $request->input('is_dropdown', '0');
        $is_dropdown = !empty($request->is_dropdown) ? '1' : '0';

        $linkType = $request->input('link_type');


        $sidebarlink = $is_dropdown == "0" ? ($linkType === 'dynamic_module' ? 'show.datatable' : $request->input('sidebar_link', null)) : null;

        $sidebarattribute = $is_dropdown == "0" ? ($linkType === 'dynamic_module' ? $request->input('module_name', null) : $request->input('sidebar_link_attribute', null)) : null;

        $sidebar = Sidebar::updateOrCreate(
            ['id' => $id], // Condition for update or create new module
            [
                'sidebar_label' => $request->input('sidebar_label', null),
                'link_type' => $linkType,
                'sidebar_link' => $sidebarlink,
                'sidebar_link_attribute' => $sidebarattribute,
                'sidebar_icon' => $request->input('sidebar_icon', null),
                'sidebar_roles' => $roles,
                'is_dropdown' => $is_dropdown,
                'parent_id' => (int) $request->input('parent_id', 0),
                'created_by' => Auth::id(),
                'dy_module' => $linkType === 'dynamic_module' ? "1" : "0",
                'module_name' => $request->input('module_name', null),
                'permissions_slug' => $sidebarlink != "dynamic_module" ?
                    Str::slug($request->input('permissions_slug', null)) : null,
            ]
        );

        $responseData = $sidebar
            ? ['success' => true, 'Status' => 200, 'Message' => 'The sidebar has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'Module could not be saved.'];

        return response()->json($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Get Sidebar Data For Sorting
    public function sortData(Request $request)
    {
        $parent_id = $request->parent_id;


        $sidebar = Sidebar::where('parent_id', $parent_id)
            ->orderBy('sidebar_sort_index')
            ->get();

        // dd($sidebar);
        $responseText = $sidebar && $sidebar->isNotEmpty() ?
            ['status' => 200, 'message' => 'Sidebar Data Found Succesfully..', 'data' => $sidebar]
            :
            ['status' => 404, 'message' => 'Sidebar data not found for sorting', 'data' => []];

        return response()->json($responseText);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------------------------------
    #Update soting of Sidebar (Parent Or Child Both)
    public function update_sortData(Request $request)
    {
        $SidebarData = $request->json()->all();


        $error = "";
        foreach ($SidebarData['data'] as $data) {
            $sidebar = Sidebar::find($data['id']);
            if ($sidebar) {
                $sidebar->sidebar_sort_index = $data['position'];
                $sidebar->save();
            } else {
                $error = "error";
            }
        }


        $responsetext = empty($error) ? ['status' => 200, 'message' => 'Sidebar sorting updated successfully'] : ['status' => 500, 'message' => 'Failed to update sorting !'];


        return response()->json($responsetext);
    }
    #----------------------------------------------------------------------------------------------------------------------------------------------------

    #====================================================================================================================================================
    #===========================================================End Sidebar Function=====================================================================
    #====================================================================================================================================================

}
