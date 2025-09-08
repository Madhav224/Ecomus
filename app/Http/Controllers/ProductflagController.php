<?php

namespace App\Http\Controllers;

use App\Models\ProductFlag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class ProductflagController extends Controller
{
    private $module_slug = 'productflags';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);


        if ($request->ajax()) {
            $Data = ProductFlag::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Flag Name',
                'Product',
                'Batch Color',
                'UpdateDate'
            ];
            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);

            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);



            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('flag_name', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {


                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';

                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-ProductflagModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('product_flags') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger ms-25 delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . encrypt_to('product_flags') . '/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';


                $actionButtons .= $statuspermission ? '<div class="datatable-switch ms-25 form-check form-switch form-check-primary d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('product_flags') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';

                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->flag_name ?? '--';
                $row[] = $data->product_names ?? '--';
                $row[] = $data->batch_color ?? '--';
                $row[] = $data->updated_at ?? '--';
                $tbody_data[$key] = $row;
            }



            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }


        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Product Flag list")],
        ];
        $file['title'] = ucwords("Product Flag list");

        $product = Product::where('status', 'active')
            ->orderByDesc('id')
            ->get(['id', 'product_name'])
            ->map(fn($item) => ['value' => $item->id, 'label' => ucfirst($item->product_name)])
            ->toArray();



        $file['ProductflagDataFilterData'] = [
            'name' => 'Product Flag',
            'action' => route('productflag.index'),
            'bulk_action_url' => encrypt_to('product_flags'),
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['ProductflagFormData'] = [
            'name' => 'productflags_form',
            'action' => route('productflag.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Product Flag',
            'btnGrid' => 4,
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
                    'name' => 'flag_name',
                    'label' => 'Flag Name',
                    'placeholder' => 'Flag Name',
                    'value' => '',
                    'grid' => '6',

                ],

                [
                    'tag' => 'input',
                    'type' => 'color',
                    'name' => 'batch_color',
                    'label' => 'Batch Colour',
                    'placeholder' => 'Colour',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'select2',
                    'name' => 'product_id',
                    'label' => 'Products',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'data' => $product,
                    'grid' => '12',
                ],
            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary open-my-model" mymodel="ProductflagModel"><i
                    data-feather="plus"></i>&nbsp;Add
                FLag</a>'
            : '';

        return view('productflags.productflag', $file);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id = $request->input('id');
        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'flag_name' => 'required|unique:product_flags,flag_name,' . $id,
            'product_id' => 'required',
            'batch_color' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);



        $blog = ProductFlag::updateOrCreate(
            ['id' => $id],
            [
                'flag_name' => $request->input('flag_name'),
                'product_id' => $request->input('product_id'),
                'batch_color' => $request->input('batch_color'),

            ]
        );
        $responseData = $blog
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Blog has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Blog could not be saved.'];

        return response()->json($responseData);
    }
}
