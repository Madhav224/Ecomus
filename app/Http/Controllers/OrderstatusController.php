<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;


class OrderstatusController extends Controller
{
    private $module_slug = 'orderstatus';

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
            $Data = OrderStatus::orderByDesc('sort_status');
            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


            $thead = [
                // '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Status',
                'Status Group',
                'UpdateDate'
            ];
            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);


            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('coupon_name', 'LIKE', '%' . $request->search . "%")->orWhere('coupon_code', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();


            foreach ($tbody_data as $key => $data) {
                $row = [];

                // if ($deletepermission || $statuspermission) {
                //     $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                // }

                $actionButtons = '';

                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-BlogModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('order_statuses') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';



                // $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status ms-25 bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . encrypt_to('order_statuses') . '/' . encrypt_to($data->id) . '">
                //     <span class="avatar-content">
                //         <span class="avatar-content">
                //             <i data-feather=\'trash-2\' class="avatar-icon"></i>
                //         </span>
                //     </a>' : '';


                // $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary ms-25 d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                //     <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('order_statuses') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                //         <label class="form-check-label" for="StatusSwitch' . $key . '">
                //             <span class="switch-icon-left"><i data-feather="check"></i></span>
                //             <span class="switch-icon-right"><i data-feather="x"></i></span>
                //         </label>
                //     </div>' : '';



                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->orderstatus_name ?? '--';
                $row[] = $data->status_group ?? '--';
                $row[] = $data->updated_at ?? '--';

                $tbody_data[$key] = $row;
            }


            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }


        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Order Status list")],
        ];
        $file['title'] = ucwords("Order Status list");


        $file['OrderstatusDataFilterData'] = [
            'name' => 'Coupon',
            'action' => route('orderstatus.index'),
            'bulk_action_url' => encrypt_to('order_statuses'),
            // 'bulk_delete' => $deletepermission,
            // 'bulk_status' => $statuspermission,
            'bulk_delete' => false,
            'bulk_status' => false,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['OrderstatusFormData'] = [
            'name' => 'blog_form',
            'action' => route('orderstatus.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Status',
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
                    'name' => 'orderstatus_name',
                    'label' => 'Order Status',
                    'placeholder' => 'Order Status',
                    'value' => '',
                    'grid' => '12',
                ],
                [
                    'tag' => 'select',
                    'name' => 'status_group',
                    'label' => 'Status Group',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => 'disabled',
                    'data' => [
                        ['value' => 'pending', 'label' => 'pending'],
                        ['value' => 'processing', 'label' => 'processing'],
                        ['value' => 'complete', 'label' => 'complete'],
                        ['value' => 'cancel', 'label' => 'cancel'],
                    ],
                    'grid' => '12',
                ],

                [
                    'tag' => 'input',
                    'type' => 'color',
                    'name' => 'bg_color',
                    'label' => 'background color',
                    'placeholder' => 'background color',
                    'value' => '',
                    'grid' => '6',
                ],

            ],
        ];

        // $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary mb-1 open-my-model" mymodel="BlogModel"><i
        //             data-feather="plus"></i>&nbsp;Add
        //         Status</a>'
        //     : '';
        $file['breadcrumbButton']['button'] = '<a href="#" class="btn btn-outline-primary mb-1  status_sorting" ><i
                data-feather="list"></i>&nbsp;
            Status Sorting</a>';
        return view('order.orderstatus', $file);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id', 0);
        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'orderstatus_name' => 'required|string|unique:order_statuses,orderstatus_name,' . $id,
            'bg_color' => 'required',
        ]);


        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $Coupon = OrderStatus::updateOrCreate(
            ['id' => $id],
            [
                'orderstatus_name' => strtolower($request->input('orderstatus_name')),
                'bg_color' => $request->input('bg_color'),
                // 'status_group' =>$request->input('status_group'),
            ]
        );
        $responseData = $Coupon
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Ordre Status has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Ordre Status could not be saved.'];

        return response()->json($responseData);
    }


    #----------------------------------------------------------------------------------------------------------------------------
    #shorting oprder
    public function sortData(Request $request)
    {
        $statuses = OrderStatus::orderBy('sort_status')
            ->get();

        $responseText = $statuses && $statuses->isNotEmpty() ?
            ['status' => 200, 'message' => 'Status Data Found Succesfully..', 'data' => $statuses]
            :
            ['status' => 404, 'message' => 'Status data not found for sorting', 'data' => []];

        return response()->json($responseText);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    public function update_sortData(Request $request)
    {
        $SidebarData = $request->json()->all();


        $error = "";
        foreach ($SidebarData['data'] as $data) {
            $sidebar = OrderStatus::find($data['id']);
            if ($sidebar) {
                $sidebar->sort_status = $data['position'];
                $sidebar->save();
            } else {
                $error = "error";
            }
        }

        $responsetext = empty($error) ? ['status' => 200, 'message' => 'Status sorting updated successfully'] : ['status' => 500, 'message' => 'Failed to update sorting !'];

        return response()->json($responsetext);
    }
}
