<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\RateLimiter;
use Intervention\Image\Facades\Image;
use App\Models\StaffRole;


class UserController extends Controller
{
    private $module_slug = 'user';

    #-------------------------------------------------------------------------------------------------------------------------------------------
    # user data type wise module
    public function index($type = 'staff')
    {
        if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read')))
            abort(403, UNAUTH_403_MESSAGE);


        $file['breadcrumbs'] = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"], ['name' => ucwords("$type list")]];

        $file['breadcrumbButton']['button'] = (Auth::user()->hasRole(['admin', 'supperadmin']) ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create')))
            ? '<a href="' . route('create.user') . '" class="btn btn-primary" ><i data-feather="plus"></i> Add ' . ucwords($type) . '</a>'
            : '';

        $file['title'] = ucwords("$type list");
        $file['user_list_type'] = $type;
        $file['userListFormData'] = [
            'name' => 'userlist-form',
            'action' => route('getUserList'),
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'user_list_type',
                    'label' => '',
                    'placeholder' => 'user_list_type',
                    'value' => $type,
                    'grid' => '1',
                ]
            ],
        ];

        return view('user.list', $file);
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
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"], ['name' => $title]];

        $userData = Administrator::find(decrypt_to($id));
        $StaffRole = StaffRole::get();

        if ($id != 0 && is_null($userData))
            abort(404);


        return view('user.form', compact('title', 'id', 'breadcrumbs', 'userData', 'StaffRole'));
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    # Store User
    public function StoreUsers(Request $request)
    {
        $id = decrypt_to($request->id);

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


        $validator = Validator::make($request->all(), [
            'user_type' => (Auth::user()->hasRole('supperadmin') ? 'required|in:admin,staff' : 'required|in:staff'),
            // 'user_type' => 'required|in:admin,staff',
            'name' => 'required',
            'profile_image' => 'mimes:jpeg,jpg,png,webp|max:1000',
            'staff_role_id' => 'required_if:user_type,staff',
            'mobile' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'size:10',
                function ($attr, $val, $fail) use ($request) {
                    if (Administrator::where('mobile', encrypt_to($val))->when($request->id, fn($q) => $q->where('id', '!=', decrypt_to($request->id)))->exists()) {
                        $fail('The ' . $attr . ' has already been taken.');
                    }
                },
            ],
            'email' => [
                'required',
                'email',
                function ($attr, $val, $fail) use ($request) {
                    if (Administrator::where('email', encrypt_to($val))->when($request->id, fn($q) => $q->where('id', '!=', decrypt_to($request->id)))->exists()) {
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
            ]
        ]);

        if ($validator->fails())
            return faildResponse(['Message' => 'Validaiton Warning', 'Data' => $validator->errors()->toArray()]);

        $user = Administrator::find($id);

        $profile_picture = $user->profile_picture ?? null;

        if ($request->hasFile('profile_image') && !empty($request->file('profile_image'))) {
            $image = $request->file('profile_image');
            $path = PATH . USER;

            if (!empty($profile_picture) && url_file_exists($path . '/' . $user->profile_picture) && $user->profile_picture != 'default.webp')
                unlink($path . '/' . $user->profile_picture);

            $profile_picture = $filename = date('dmYHis') . uniqid() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image)->encode('jpg', 80)->resize(300, 300)->save($path . '/' . $filename);
        }

        $userSaveData = [
            'parent_id' => Auth::id(),
            'usercode' => rand(111111, 999999),
            'username' => substr(strtolower(str_replace(' ', '_', $request->name)), 0, 12),
            'name' => $request->name,
            'profile_picture' => $profile_picture,
            'mobile' => encrypt_to($request->mobile),
            'email' => encrypt_to($request->email),
            'password' => bcrypt($request->password),
            'user_position' => $request->user_type,
            'registered_ip' => $request->ip(),
            'user_remark' => $request->user_remark,
            'staff_role_id' => $request->staff_role_id,
        ];

        if (!empty($request->id)) {
            unset($userSaveData['usercode']);
            unset($userSaveData['parent_id']);
            unset($userSaveData['password']);
            unset($userSaveData['user_position']);
            unset($userSaveData['registered_ip']);
        }


        $user = Administrator::updateOrCreate(['id' => $id], $userSaveData);

        if (empty($request->id)) {
            $user->assignRole($request->user_type);
        }


        return successResponse(['Message' => 'Success!', 'Data' => [], 'Redirect' => route('view.user', [$user->getRoleNames()->first()])]);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #Function to get User List
    public function getUserList(Request $request)
    {

        if ($request->ajax()) {
            if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read')))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


            $user_list_type = $request->user_list_type ?: 'staff';

            $Data = Administrator::role([$user_list_type])
                ->with('roles')
                ->when(!Auth::user()->hasRole('supperadmin'), fn($q) => $q->where('parent_id', Auth::id()))
                ->orderBydesc('id');


            $updateuser = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
            $deleteuser = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
            $statususer = Auth::user()->hasRole(['admin', 'supperadmin']) ||
                (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));

            $resetpassword = Auth::user()->hasRole(['supperadmin', 'admin']);
            $thead = ['Name'];

            array_push($thead, ($deleteuser || $updateuser || $statususer) ? 'Action' : null, (Auth::user()->hasRole(['staff', 'admin']) ? 'Staff Role' : null), 'Login Time', 'Login IP', 'Join Date');

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%")
                        ->orWhere('usercode', 'LIKE', '%' . $request->search . "%")
                        ->orWhere('created_at', 'LIKE', '%' . $request->search . "%");
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
                        ($resetpassword ? ' <div class="avatar avatar-status bg-light-warning itsrst-pass" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Password" rstpassto="' . str_replace(url('/') . '/', '', route('resetpassword.user', [encrypt_to($data->id)])) . '">
                            <span class="avatar-content">
                                <i data-feather=\'key\' class="avatar-icon"></i>
                            </span>
                        </div>' : '') .

                        ($resetpassword ? '<div class="avatar avatar-status bg-light-success itclrlogin ms-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear Login Attempt" clrloginto="' . str_replace(url('/') . '/', '', route('clearloginlttempts.user', [encrypt_to($data->usercode)])) . '">
                            <span class="avatar-content">
                                <i data-feather=\'unlock\' class="avatar-icon"></i>
                            </span>
                        </div>' : '') .
                        ($updateuser ?
                            '<a href="' . Route('edit.user', [encrypt_to($data->id)]) . '"class="avatar avatar-status bg-light-info ms-25" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <span class="avatar-content">
                                <i data-feather=\'edit\' class="avatar-icon"></i>
                            </span>
                        </a>' : '') .
                        ($deleteuser ?
                            '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger  delete_record ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"  deleteto="delete/user/' . encrypt_to($data->id) . '" >
                                <span class="avatar-content">
                                    <span class="avatar-content">
                                        <i data-feather=\'trash-2\' class="avatar-icon"></i>
                                    </span>
                         </a>' : '') .

                        ($statususer ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle ms-25"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->user_status == 'active' ? 'Deactivate' : 'Activate') . '">
                        <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->user_status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('administrators') . '/' . encrypt_to($data->id) . '/' . encrypt_to('user_status') . '"/>
                            <label class="form-check-label" for="StatusSwitch' . $key . '">
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                        </div>' : ''),
                        $data->staff_role_id ? '<span class="badge bg-light-primary">' . $data->staffrole->name . '</span>' : null,
                        date('Y-m-d H:i:s', strtotime($data->last_login_at)),
                        $data->last_login_ip ?: '-',
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

    #----------------------------------------------------------------
    #Function to get User Avatar Group
    public function getUsersAvatarGroup($UsersGroup = [], $count = 0)
    {
        if (!$UsersGroup)
            return '';
        $AvatarGroup = '<div class="avatar-group">';
        foreach ($UsersGroup as $key => $user) {
            $Initials = getInitials($user->name);
            $randomState = getRandomColorState();

            $user_parent_profile = '<span class="avatar-content bg-' . $randomState . '">' . $Initials . '</span>';

            $user_parent_profile = url_file_exists(URL . USER . $user->profile_picture) ?
                '<img src="' . URL . USER . $user->profile_picture . '" alt="' . $user->name . '" height="32" width="32">' : $user_parent_profile;

            $AvatarGroup .= '<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"       title="' . $user->name . '" class="avatar pull-up avatar-sm bg-' . $randomState . '">
                    ' . $user_parent_profile . '
                </div>';
        }
        $userCount = $count - $UsersGroup->count();
        $AvatarGroup .= '<h6 class="align-self-center cursor-pointer ms-50 mb-0">' . (($userCount) > 0 ? '+' . $userCount : '') . '</h6>
        </div>';

        return $AvatarGroup;
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------


    #-------------------------------------------------------------------------------------------------------------------------------------------
    #Function to Reset Password
    public function userPasswordReset(Request $request, $id = 0)
    {
        if ($id == 0)
            return response()->json([]);

        $user = Administrator::where('id', decrypt_to($id))->update(['password' => bcrypt('12345678')]);
        if ($user)
            return successResponse(['Message' => 'Password Reseted Successfully!']);

        return faildResponse(['Message' => 'Something went wrong!']);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    # Clear Login limite Attempts.
    public function clearLoginAttempts(Request $request, $code = '')
    {
        RateLimiter::clear(decrypt_to($code));
        return successResponse(['Message' => 'Cleared Login Attempts Successfully!']);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #SoftDelete User
    public function deleteUser($id = 0)
    {
        if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

        $user = Administrator::findOrFail(decrypt_to($id));

        if ($user) {
            $user->delete();
            return successResponse(['Message' => 'User Deleted Successfully!']);
        }

        return faildResponse(['Message' => 'Something went wrong!']);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #Destroy User Permanently
    public function forceDelete($id)
    {
        $user = Administrator::withTrashed()->findOrFail($id);
        $user->forceDelete(); // Permanently deletes the user
        return response()->json(['message' => 'User permanently deleted']);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

    #-------------------------------------------------------------------------------------------------------------------------------------------
    #restore User
    public function restore($id)
    {
        $user = Administrator::withTrashed()->findOrFail($id);
        $user->restore();
        return response()->json(['message' => 'User restored successfully']);
    }
    #-------------------------------------------------------------------------------------------------------------------------------------------

}
