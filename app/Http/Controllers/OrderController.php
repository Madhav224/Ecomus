<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToArray;

class OrderController extends Controller
{
    private $module_slug = 'orders';

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);

        if ($request->ajax()) {
            $Data = Order::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $order_status = OrderStatus::select('id', 'orderstatus_name')
                ->where('status', 'active')
                ->orderBy('sort_status')
                ->get()
                ->pluck('orderstatus_name', 'id')
                ->toArray();

            $thead = [
                'order number',
                'user name',
                'order status',
                'payment type',
                'payment status',
                'total amount',
                'order date',
            ];


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('order_number', 'LIKE', '%' . $request->search . "%");
                });
            }

            $limit = $request->limit ? $request->limit : 5;
            $tbody = $Data->paginate($limit);
            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {
                $profile = $this->getUserNameWithAvatar($data?->user?->name, URL . USER . $data?->user?->profile_picture, $data?->user?->usercode);


                $status = "<form class='statusForm'><select class='form-select form-select-sm order_status' name='order_status' data-orderid='" . $data->id . "'
                data-oldstatus='" . $data->order_status . "' id='order_status_" . $data->id . "'>
                    ";
                foreach ($order_status as $status_id => $status_name) {
                    $status .= "<option value='" . $status_id . "' " . ($data->order_status == $status_id ? 'selected' : '') . ">" . ucfirst($status_name) . "</option>";
                }
                $status .= "</select></form>";
                $tbody_data[$key] = [
                    "<a href='" . (route('order.details', encrypt_to($data->id))) . "'>" . $data->order_number . "</a>" ?? '--',
                    $profile,
                    $status,
                    $data->payment_type ?? '--',
                    $data->payment_status ?? '--',
                    $data->total_amount ?? '--',
                    $data->updated_at ?? '--',
                ];
            }
            $tbody->setCollection(new Collection($tbody_data));


            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }



        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Order list")],
        ];
        $file['title'] = ucwords("Order list");

        $file['OrderDataFilterData'] = [
            'name' => 'order',
            'action' => route('order.index'),
            'bulk_action_url' => 'order',
            'bulk_delete' => false,
            'bulk_status' => false,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        return view('order.index', $file);
    }

    public function OrderDetails($id)
    {
        $id = decrypt_to($id);
        $order = Order::findOrFail($id);
        if (!$order)
            abort(404);

        $file['orderChild'] = $order?->child;
        $file['user'] = $order?->user;

        $file['order'] = $order;
        $file['billing_address'] = $order->Address()->where('address_type', 'billing')->first();
        $file['delivery_address'] = $order->Address()->where('address_type', 'delivery')->first();



        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],
            ['link' => route('order.index'), 'name' => "Orders"],
            ['name' => ucwords("Order Details")],
        ];
        $file['title'] = ucwords("Order Details");


        return view('order.orderdetails', $file);

    }

    #Order Invoice START
    public function printInvoice($id)
    {
        $id = decrypt_to($id);
        $order = Order::findOrFail($id);
        if (!$order)
            abort(404);

        $orderChild = $order->child;
        $user = $order->user;
        $billing_address = $order->Address()->where('address_type', 'billing')->first();
        $delivery_address = $order->Address()->where('address_type', 'delivery')->first();

        // dd($orderChild);

        // $file['breadcrumbs'] = [
        //     ['link' => "/", 'name' => "Home"],
        //     ['link' => route('order.index'), 'name' => "Orders"],
        //     ['name' => ucwords("Order Invoice")],
        // ];
        $file['title'] = env('APP_NAME');

        return view('order.invoice', $file, compact('order', 'orderChild', 'user', 'billing_address', 'delivery_address'));

    }
    #ORDER Invoice END

    #ORDER Status Update START
    public function OrderStatus(Request $request)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);



        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'order_status' => 'required|exists:order_statuses,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);

        }

        $order = Order::find($request->order_id);
        if (!$order)
            return response()->json(['success' => false, 'status' => 404, 'message' => "Order not found"]);
        // dd($request->all(),$order);
        $order->order_status = $request->order_status;
        $order->save();
        return response()->json(['success' => true, 'status' => 200, 'message' => "Order status updated successfully"]);
    }
    #ORDER Status Update END


    #-------------------------------------------------------------------------------------------------------------------------------------------
    #Function to get User List
    public function getUserNameWithAvatar($name = '', $image = NULL, $position = ' ')
    {
        if ($name == '')
            return $name;
        $Initials = getInitials($name);
        $randomState = getRandomColorState();
        $user_parent_profile = '<span class="avatar-content">' . $Initials . '</span>';

        $user_parent_profile = url_file_exists($image) ?
            '<img src="' . $image . '" alt="' . $name . '" height="32" width="32">' : $user_parent_profile;

        $user_parent_profile =
            '<div class="d-flex justify-content-left align-items-center">
                <div class="avatar-wrapper">
                    <div class="avatar  bg-light-' . $randomState . '  me-1">
                    ' . $user_parent_profile . '
                    </div>
                </div>
                <div class="d-flex flex-column text-start">
                    <a href="javascript:void(0);" class="user_name text-truncate text-body">
                    <span class="fw-bolder">' . ucwords($name) . '</span>
                    </a>
                    <small class="emp_post text-muted">' . $position . '</small>
                </div>
            </div>';
        return $user_parent_profile;
    }
    #----------------------------------------------------------------

}
