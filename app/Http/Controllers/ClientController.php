<?php

namespace App\Http\Controllers;

use App\Models\ModuleCountry;
use App\Models\ModuleState;
use App\Models\ModuleCity;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ClientController extends Controller
{
    private $module_slug = 'client';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = "Clients";

        if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read')))
            abort(403, UNAUTH_403_MESSAGE);


        $file['breadcrumbs'] = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"], ['name' => ucwords("$type list")]];

        // $file['breadcrumbButton']['button'] = (Auth::user()->hasRole(['admin', 'supperadmin']) ||
        //     (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create')))
        //     ? '<a href="' . route('create.client') . '" class="btn btn-primary" ><i data-feather="plus"></i> Add ' . ucwords($type) . '</a>'
        //     : '';

        $file['title'] = ucwords("$type list");
        $file['clientListTableData'] = [
            'name' => 'clientlist-form',
            'action' => route('getClientList'),
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        return view('client.list', $file);
    }

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #Function to get User List
    public function getClientList(Request $request)
    {

        if ($request->ajax()) {
            if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read')))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $Data = User::orderBydesc('id');


            $updateuser = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
            $deleteuser = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
            $statususer = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));

            $resetpassword = Auth::user()->hasRole(['supperadmin', 'admin']);
            $thead = ['Name'];

            array_push($thead, ($deleteuser || $updateuser || $statususer) ? 'Action' : null, 'Name', 'Email', 'Phone No', 'Updated At');

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                });
            }

            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);

            $tbody_data = $tbody->items();
            foreach ($tbody_data as $key => $data) {
                $profile = $this->getUserNameWithAvatar($data->name, URL . USER . $data->profile_picture, $data->usercode);

                $tbody_data[$key] = [
                    $profile
                ];

                $tbody_data[$key] = array_merge(
                    $tbody_data[$key],
                    [
                        // ($updateuser ?
                        //     '<a href="' . Route('edit.client', [encrypt_to($data->id)]) . '"class="avatar avatar-status bg-light-info ms-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                        //     <span class="avatar-content">
                        //         <i data-feather=\'edit\' class="avatar-icon"></i>
                        //     </span>
                        // </a>' : '') .
                        // ($deleteuser ?
                        //     '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger  delete_record ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"  deleteto="delete/client/' . encrypt_to($data->id) . '" >
                        //         <span class="avatar-content">
                        //             <span class="avatar-content">
                        //                 <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        //             </span>
                        //  </a>' : '') .

                        ($statususer ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle ms-25"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                        <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('users') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                            <label class="form-check-label" for="StatusSwitch' . $key . '">
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                        </div>' : ''),
                        $data->name,
                        $data->email,
                        $data->phone_no,
                        date('Y-m-d H:i:s', strtotime($data->created_at)),
                    ]
                );
            }
            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #user form module
    public function form($id = 0)
    {
        if (!Auth::user()->hasRole(['supperadmin', 'admin', 'staff']))
            abort(403, UNAUTH_403_MESSAGE);

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission))
            abort(403, UNAUTH_403_MESSAGE);


        $title = ucwords(($id > 0 ? "Edit" : "Add") . " Account");
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => route('client.index'), 'name' => "Client"], ['name' => $title]];

        $userData = User::with([
            'Address' => function ($query) {
                $query->where('default', '1');
            }
        ])->find(decrypt_to($id));

        $countries = ModuleCountry::select('id', 'country_name')->get();
        $states = ModuleState::select('id', 'state_name')->get();


        if ($id != 0 && is_null($userData))
            abort(404);

        $UserAddress = $userData?->Address->first();

        return view('client.form', compact('title', 'id', 'breadcrumbs', 'userData', 'UserAddress', 'countries', 'states'));
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = decrypt_to($request->id);
        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'profile_image' => 'mimes:jpeg,jpg,png,webp|max:200',
                'phone_no' => [
                    'required',
                    'regex:/^([0-9\s\-\+\(\)]*)$/',
                    'size:10',
                    function ($attr, $val, $fail) use ($request) {
                        if (User::where('phone_no', encrypt_to($val))->when($request->id, fn($q) => $q->where('id', '!=', decrypt_to($request->id)))->exists()) {
                            $fail('The ' . $attr . ' has already been taken.');
                        }
                    },
                ],
                'email' => [
                    'required',
                    'email',
                    function ($attr, $val, $fail) use ($request) {
                        if (User::where('email', encrypt_to($val))->when($request->id, fn($q) => $q->where('id', '!=', decrypt_to($request->id)))->exists()) {
                            $fail('The ' . $attr . ' has already been taken.');
                        }
                    },
                ],
                'password' => [
                    function ($attribute, $value, $fail) use ($request) {
                        if (empty($request->id) && empty($value)) {
                            return $fail('The ' . $attribute . ' field is required.');
                        }
                        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#.\-?!@$%^&*])[A-Za-z\d#.\-?!@$%^&*]{8,20}$/', $value)) {
                            return $fail('Password must be 8-20 characters with uppercase, lowercase, number & special character.');
                        }
                        if ($value !== ($request->confirm_password ?? '')) {
                            return $fail('Password and Confirm Password must match.');
                        }
                    }
                ],
                'confirm_password' => [
                    fn($attr, $val, $fail) => (empty($request->id) && empty($val)) ? $fail('The ' . $attr . ' field is required.') : null
                ],
                'pincode' => 'required|digits:6',
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'required|string|max:255',
                'user_country_id' => 'required|exists:module_countries,id',
                'user_state_id' => 'required|exists:module_states,id',
                'user_city_id' => 'required|exists:module_cities,id',
            ],
            [
                'address_line_1' => 'address is required.',
                'address_line_2' => 'address is required.',
            ]
        );

        if ($validator->fails())
            return faildResponse(['Message' => 'Validaiton Warning', 'Data' => $validator->errors()->toArray()]);


        $user = User::find($id);

        $profile_picture = $user->profile_image ?? null;


        $directory = public_path('upload/clients');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = date('dmYHis') . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!empty($profile_picture) && File::exists(public_path($profile_picture)) && $profile_picture != 'default.webp')
                File::delete(public_path($profile_picture));

            $image->move($directory, $filename);
            $profile_picture = 'upload/clients/' . $filename;
        }

        $userSaveData = [
            'name' => $request->name,
            'profile_image' => $profile_picture,
            'phone_no' => encrypt_to($request->phone_no),
            'email' => encrypt_to($request->email),
            'password' => encrypt_to($request->password),
            'user_city_id' => $request->user_city_id,
            'user_state_id' => $request->user_state_id,
            'user_country_id' => $request->user_country_id,
            'pincode' => $request->pincode,
            'phone_verified' => 'verified',
            'phone_verified_at' => Carbon::now()->toDateTimeString(),
        ];

        if (!empty($request->id)) {
            unset($userSaveData['password']);
            unset($userSaveData['phone_verified']);
            unset($userSaveData['phone_verified_at']);
        }


        $user = User::updateOrCreate(['id' => $id], $userSaveData);


        $address_id = $request?->address_id ?? 0;

        $user_address = UserAddress::updateOrCreate(
            [
                'user_id' => $user->id,
                'id' => $address_id,
                'default' => 1,
            ],
            [
                'user_id' => $user->id,
                'name' => $user->name,
                'phone_no' => encrypt_to($request->phone_no),
                'pincode' => $user->pincode,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'landmark' => $request->landmark,
                'city' => $user->City->city_name,
                'state_id' => $user->State->id,
                'country_id' => $user->Country->id,
                'default' => '1',
            ]
        );


        if ($user_address) {
            UserAddress::where('id', '!=', $user_address->id)
                ->where('user_id', $user->id)
                ->update(['default' => '0']);
        }

        $response = $user && $user_address ?
            successResponse(['Message' => 'Success!', 'Data' => [], 'Redirect' => route('client.index')]) :
            faildResponse(['Message' => 'User Not Saved', 'Data' => []]);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['Status' => 404, 'message' => 'User Data does not Delete']);
        }

        $path = public_path($user->profile_image);

        if (File::exists($path))
            File::delete($path);

        $user->delete();
        return response()->json(['Status' => 200, 'Message' => 'User Data Delete successfully']);
    }

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


    public function getCities(Request $request)
    {
        $state_id = $request->state_id;

        if ($state_id == null || $state_id == 0)
            return response()->json([
                'status' => 400,
                'message' => 'Cities not found.',
                'data' => [],
            ]);



        $cities = ModuleCity::where('state_name', $state_id)
            ->select('id', 'city_name')
            ->get()
            ->toarray();

        return response()->json([
            'status' => $cities ? 200 : 400,
            'message' => $cities ? 'Cities found successfully.' : 'Cities not found.',
            'data' => $cities ? $cities : [],
        ]);
    }
}
