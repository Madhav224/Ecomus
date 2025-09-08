<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    private $module_slug = 'coupons';
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
            $Data = Coupon::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Coupon Name',
                'Coupon Code',
                'Coupon Value',
                'Start Date',
                'End Date',
                'Minimum Purchase',
                'use Limit',
                'For new Member',
                'User Usage Type',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);


            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('coupon_name', 'LIKE', '%' . $request->search . "%")
                        ->orWhere('coupon_code', 'LIKE', '%' . $request->search . "%")
                        ->orWhere('amount', 'LIKE', '%' . $request->search . "%")
                    ;
                });
            }


            $limit = $request->limit ? $request->limit : 5;
            $tbody = $Data->paginate($limit);
            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {
                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '">';
                }

                $actionButtons = '';

                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary ms-25 openmodal-CouponModel" title="Edit" recordof="' . encrypt_to('coupons') . '/' . encrypt_to($data->id) . '"><span class="avatar-content"><i data-feather="edit" class="avatar-icon"></i></span></a>' : '';



                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger ms-25 delete_record" title="Delete" deleteto="' . encrypt_to('coupons') . '/' . encrypt_to($data->id) . '"><span class="avatar-content"><i data-feather="trash-2" class="avatar-icon"></i></span></a>' : '';



                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block ms-25 align-middle" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                        <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('coupons') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';



                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->coupon_name ?? '--';
                $row[] = $data->coupon_code ?? '--';
                $row[] = ($data->value_type == "in_percentage" ? ($data->value . '%') : ('₹' . $data->value)) ?? '--';
                $row[] = $data->start_date ?? '--';
                $row[] = $data->end_date ?? '--';
                $row[] = $data->min_amount ?? '--';
                $row[] = $data->use_limit ?? '--';
                $row[] = ($data->for_new_member == "1" ? "true" : "false") ?? '--';
                $row[] = ($data->user_usage_type == "once" ? "One Time" : "Multiple Times") ?? '--';
                $row[] = $data->updated_at ?? '--';

                $tbody_data[$key] = $row;
            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();

        }

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Coupon list")],
        ];
        $file['title'] = ucwords("Coupon list");


        $file['CouponDataFilterData'] = [
            'name' => 'Coupon',
            'action' => route('coupon.index'),
            'bulk_action_url' => encrypt_to('coupons'),
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['CouponFormData'] = [
            'name' => 'coupon_form',
            'action' => route('coupon.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Coupon',
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
                    'name' => 'coupon_name',
                    'label' => 'Coupon Name',
                    'placeholder' => 'Coupon Name',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'coupon_code',
                    'label' => 'Coupon Code',
                    'placeholder' => 'Coupon Code',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'radio',
                    'name' => 'value_type',
                    'label' => 'Type',
                    'element_extra_classes' => '',
                    'outer_div_classes' => '',
                    'grid' => '6',
                    'placeholder' => '',
                    'value' => 'in_percentage',
                    'data' => [
                        ['value' => 'in_percentage', 'label' => 'In Percentage'],
                        ['value' => 'in_amount', 'label' => 'In Amount'],
                    ],
                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'name' => 'value',
                    'label' => 'Value',
                    'placeholder' => 'Value',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'name' => 'min_amount',
                    'label' => 'Minimum Purchase',
                    'placeholder' => 'Minimum Amount',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'name' => 'use_limit',
                    'label' => 'Use Limit',
                    'placeholder' => 'Use Limit(e.g. 1,5)',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'date',
                    'name' => 'start_date',
                    'label' => 'Start Date',
                    'placeholder' => 'Start Date',
                    'outer_div_classes' => '',
                    // 'element_extra_attributes' => "min='" . \Carbon\Carbon::today()->toDateString() . "'",
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'date',
                    'name' => 'end_date',
                    'label' => 'End Date',
                    'placeholder' => 'End Date',
                    'outer_div_classes' => '',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'checkbox',
                    'name' => 'new_member',
                    'label' => '',
                    'element_extra_classes' => '',
                    'outer_div_classes' => '',
                    'grid' => '6',
                    'placeholder' => '',
                    'value' => '',
                    'data' => [
                        ['value' => '1', 'label' => 'Only For New Members']
                    ],
                ],
                [
                    'tag' => 'input',
                    'type' => 'radio',
                    'name' => 'user_usage_type',
                    'label' => 'Usage Type',
                    'element_extra_classes' => '',
                    'outer_div_classes' => '',
                    'grid' => '6',
                    'placeholder' => '',
                    'value' => 'once',
                    'data' => [
                        ['value' => 'once', 'label' => 'One Time'],
                        ['value' => 'multiple', 'label' => 'Multiple Times'],
                    ],
                ],
                [
                    'tag' => 'select',
                    'name' => 'coupon_validate_on',
                    'label' => 'Coupon Validate On',
                    'element_extra_classes' => '',
                    'outer_div_classes' => '',
                    'grid' => '6',
                    'placeholder' => '',
                    'value' => 'cart',
                    'data' => [
                        ['value' => 'cart', 'label' => 'Cart'],
                        ['value' => 'product', 'label' => 'Product'],
                        ['value' => 'category', 'label' => 'Category'],
                    ],
                ],

            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary open-my-model" mymodel="CouponModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    Coupon</a>'
            : '';
        return view('coupon.coupon', $file);
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
            'coupon_name' => 'required|string|max:255|unique:coupons,coupon_name,' . $id,
            'coupon_code' => 'required|string|max:255|unique:coupons,coupon_code,' . $id,

            'value_type' => 'required|in:in_percentage,in_amount',
            'value' => 'required|integer|min:1',

            'min_amount' => 'required|integer|min:1',

            'use_limit' => 'required|integer|min:1',

            'user_usage_type' => 'required|in:once,multiple',
            'coupon_validate_on' => 'required|in:cart,product,category',

            // 'start_date' => 'required|date|after_or_equal:today',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);


        $validator->after(function ($validator) use ($request) {
            if ($request->amount_type === 'in_percentage' && $request->amount > 100) {
                $validator->errors()->add('amount', 'The amount must be less than or equal to 100.');
            }
        });


        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);



        $Coupon = Coupon::updateOrCreate(
            ['id' => $id],
            [
                'coupon_name' => $request->input('coupon_name'),
                'coupon_code' => $request->input('coupon_code'),
                'value_type' => $request->input('value_type'),
                'value' => $request->input('value'),
                'min_amount' => $request->input('min_amount'),
                'use_limit' => $request->input('use_limit'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'user_usage_type' => $request->input('user_usage_type'),
                'coupon_validate_on' => $request->input('coupon_validate_on'),
                'for_new_member' => !empty($request->new_member) ? '1' : '0',
            ]
        );
        $responseData = $Coupon
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Blog has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Blog could not be saved.'];

        return response()->json($responseData);
    }

}
