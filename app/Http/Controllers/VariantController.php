<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class VariantController extends Controller
{
    private $module_slug = 'variants';

    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);

        if ($request->ajax()) {
            $Data = Variant::with('parent')->orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Variant Name',
                'Variant Parent Name',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);


            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('variant_name', 'LIKE', '%' . $request->search . "%");
                });
            }

            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {

                $variantName = $data->variant_name ?? '--';
                $parentName = $data->parent->variant_name ?? '--';
                $isColor = in_array(($parentName),['color','colors','colour']);

                if ($isColor) {
                    $variantName = '<div style="color:' . $data->variant_name . ';"' . $data->variant_name . '">' . $data->variant_name . '</div>';
                }

                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';


                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-variantModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to(' variants
                        ') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . encrypt_to(' variants
') . '/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle ms-25"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('variants') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';

                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;


                $row[] = $variantName ?? '--';
                $row[] = $data->parent->variant_name ?? '--';
                $row[] = $data->updated_at ?? '--';
                $tbody_data[$key] = $row;
            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $variantOptions = Variant::select('id', 'variant_name')
            ->whereNull('variant_parent_id')
            ->orderByDesc('id')
            ->get()
            ->map(function ($variant) {
                return [
                    'value' => $variant->id,
                    'label' => $variant->variant_name,
                ];
            })
            ->toArray();

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Variant list")],
        ];
        $file['title'] = ucwords("Variant list");


        $file['VariantDataFilterData'] = [
            'name' => 'variant',
            'action' => route('variant.index'),
            'bulk_action_url' => encrypt_to('variants'),
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['VariantFormData'] = [
            'name' => 'variant_form',
            'action' => route('variant.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Variant',
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
                    'name' => 'variant_name',
                    'label' => 'Variant Name',
                    'placeholder' => 'Variant Title',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'select',
                    'name' => 'variant_parent_id',
                    'label' => 'Variant Parent Name',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'data' => $variantOptions,
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'checkbox',
                    'name' => 'is_color',
                    'label' => '',
                    // 'element_extra_classes' => 'variant-color-checkbox',
                    'grid' => '6',
                    'placeholder' => '',
                    'value' => '',
                    'data' => [
                        ['value' => '1', 'label' => 'Is Color'],
                    ],
                ],
                [
                    'tag' => 'input',
                    'type' => 'color',
                    'name' => 'variant_value',
                    'label' => '',
                    'placeholder' => 'Variant Value',
                    'value' => '',
                    'grid' => '6',
                    'element_extra_classes' => 'variant-value-color',

                ],


            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary mb-1 open-my-model" mymodel="variantModel"><i
                    data-feather="plus"></i>&nbsp;Add
                Variant</a>'
            : '';

        return view('variant.index', $file);
    }

    public function store(Request $request)
    {
        $id = $request->input('id');

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $parentId = $request->input('variant_parent_id');
        $validator = Validator::make($request->all(), [
            'variant_name' => [
                'required',
                'string',
                'max:191',
                function ($attribute, $value, $fail) use ($parentId, $id) {
                    $query = Variant::where('variant_name', $value);

                    if ($parentId === null) {
                        $query->whereNull('variant_parent_id');
                    } else {
                        $query->where('variant_parent_id', $parentId);
                    }

                    if ($id) {
                        $query->where('id', '!=', $id);
                    }

                    if ($query->exists()) {
                        $fail("The variant name '{$value}' already exists" . ($parentId ? " in the selected parent." : " as a parent variant."));
                    }
                }
            ],
            'variant_parent_id' => 'nullable|integer|exists:variants,id',
            'variant_value' => 'nullable|string|max:191',
            'is_color' => 'nullable',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);



        $variant = Variant::find($id);


        if ($request->input('variant_parent_id') === null) {

            $isColor = $request->has('is_color') ? '1' : '0';
        } else {
            $isCheck = Variant::where('id', $request->input('variant_parent_id'))->first();

            if ($isCheck) {
                $isColor = $isCheck->is_color;
            } else {
                $isColor = '0';
            }
        }

        $variantValue = $request->input('variant_value', '#000000');

        $variant = Variant::updateOrCreate(
            ['id' => $id],
            [
                'variant_name' => strtolower($request->input('variant_name')),
                'variant_value' => $variantValue,
                'variant_parent_id' => $request->input('variant_parent_id', null) ?? null,
                'is_color' => $isColor,
            ]
        );
        $responseData = $variant
            ? ['success' => true, 'Status' => 200, 'Message' => 'The variant has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The variant could not be saved.'];

        return response()->json($responseData);
    }
    
    public function variant_column()
    {
        $columns = Schema::getColumnListing('variants');
        unset($columns[0]);

        $response = $columns ?
            ['status' => 200, 'message' => 'The variant found successfully.', 'data' => $columns] :
            ['status' => 404, 'message' => 'The variant not found.', 'date' => []];
        return response()->json($response);
    }

    public function variant_change($id)
    {
        $variant_get = Variant::find($id);

        return response()->json([
            'is_color' => $variant_get?->is_color,
            'variant_value' => $variant_get?->variant_value,
        ]);

    }

}
