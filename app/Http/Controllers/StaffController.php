<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\RateLimiter;

class StaffController extends Controller
{
    // user data type wise module ---------------------
    public function index()
    {
        $file['breadcrumbs'] = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Staff"], ['name' => ucwords("Staff list")]];     
        
        $file['Data'] = '';

        $file['title'] = ucwords("Staff list");
        $file['staffListFormData'] = [
            'name'=>'stafflist-form',
            'action'=>route('getStaffList'),
            'btnGrid'=>2,
            'no_submit'=>1,
            'fieldData'=>[],
        ];
        return view('staff.viewstaff', $file);
    }
    // --------------------------------------------------

    #----------------------------------------------------------------
    #Function to get User List
    public function getStaffList(Request $request)
    {
        if ($request->ajax())
        {
            $user_list_type = 'staff'; 
            $Data = Administrator::role([$user_list_type])->with('roles');

            // $Data = $this->AuthWiseUserListCondition($Data,$user_list_type);

            $thead = ['Name','Mobile','Email','Created At','Last Login At','Action'];
            $nhed = [];        

            if(!empty($request->search))
            {
                $Data->where(function ($query) use ($request) {
                    $query->where('name','LIKE','%'.$request->search."%")
                        ->orWhere('mobile','LIKE','%'.$request->search."%")
                        ->orWhere('email','LIKE','%'.$request->search."%")
                        ->orWhere('created_at','LIKE','%'.$request->search."%");
                });
            }
           
            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);

            $tbody_data = $tbody->items();
            foreach ($tbody_data as $key => $data) {
                $profile = $this->getUserNameWithAvatar($data->name,URL.ADMIN.$data->profile_picture,$data->usercode);     
            
                $tbody_data[$key] = [
                            $profile,
                            decrypt_to($data->mobile),
                            decrypt_to($data->email),
                            date('Y-m-d H:i:s',strtotime($data->last_login_at)),
                            date('Y-m-d H:i:s',strtotime($data->created_at)),
                        ];
                        
                        $tbody_data[$key] =  array_merge($tbody_data[$key],
                        [
                        '<div class="avatar avatar-status bg-light-warning itsrst-pass" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Password" rstpassto="'.str_replace(url('/').'/','',url('reset-password',[encrypt_to($data->id)])).'">
                            <span class="avatar-content">
                                <i data-feather=\'key\' class="avatar-icon"></i>
                            </span>
                        </div>

                        <a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-staffModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="editstaff/'.encrypt_to($data->id).'" data-id="' . $data->id . '">
                            <span class="avatar-content">
                                <i data-feather=\'edit\' class="avatar-icon"></i>
                            </span>
                        </a>

                        <a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="'.encrypt_to('administrators').'/'.encrypt_to($data->id).'">
                        <span class="avatar-content">
                            <span class="avatar-content">
                                <i data-feather=\'trash-2\' class="avatar-icon"></i>
                            </span>
                        </a>

                        <div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to '.($data->user_status=='active'?'Deactivate':'Activate').'">
                        <input type="checkbox" class="form-check-input change_status" id="StatusSwitch'.$key.'" '.($data->user_status=='active'?'checked':'').' statusto="'.encrypt_to('administrators').'/'.encrypt_to($data->id).'/'.encrypt_to('user_status').'"/>                            
                            <label class="form-check-label" for="StatusSwitch'.$key.'">
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                        </div>',
                    ]);
            }
            $tbody->setCollection(new Collection($tbody_data));
            
            return view('datatable.datatable', compact('tbody','thead'))->render();
        }
        
    }
    #----------------------------------------------------------------

    # Store User-----------------------------------------
    public function StoreStaff(Request $request)
    {

        if(Auth::user()->hasRole(['staff','admin']))
            abort(404);

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'mobile' => [
                        'required',
                        'regex:/^([0-9\s\-\+\(\)]*)$/',
                        'min:10',
                        'max:16',
                        function ($attribute, $value, $fail) use ($request) {
                            // Skip validation if it's an update and the mobile number is not changed
                            if (!empty($request->id)) {
                                $existingMobile = Administrator::find(decrypt_to($request->id))->mobile ?? null;
                                if ($existingMobile && encrypt_to($value) === $existingMobile) {
                                    return; // No need to validate as the value is unchanged
                                }
                            }

                            // Validate uniqueness
                            if (empty($request->id)) {
                                $exists = Administrator::where('mobile', encrypt_to($value));
                                if (empty($request->id)) {
                                    $exists->where('id', '!=', decrypt_to($request->id));
                                }
                                if ($exists->exists()) {
                                    $fail('The ' . $attribute . ' has already been taken.');
                                }
                            }
                        },
                    ],
                    // 'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/','min:10','max:16|unique:Administrators',
                    'email' => 'required|unique:Administrators',
                    'password' => [function ($attribute, $value, $fail) use ($request) {
                                if(empty($request->id) && empty($value))
                                    $fail('The '.$attribute.' field is required');
                            }],
                    'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]); 
        if ($validator->fails()) 
            return faildResponse(['Message'=>'Validaiton Warning', 'Data'=>$validator->errors()->toArray()]);

        $validationArray = [];

        $user = Administrator::find(decrypt_to($request->id));
        $userSaveData = [
            'name' => $request->name,
            'mobile' => encrypt_to($request->mobile),
            'email' => encrypt_to($request->email),
            'username' => str_replace(' ','',$request->name).rand(111111,999999),
            'password' => bcrypt($request->password),            
            'user_position' => 'staff',            
            'registered_ip' => $request->ip(),
        ];
        
        if ($request->hasFile('account_picture')) {
            $file = $request->file('account_picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('upload/admin/');
            $file->move($destinationPath, $fileName);
            $userSaveData['profile_picture'] = $fileName;
        }
        
        $user = Administrator::updateOrCreate(['id'=>$request->id],$userSaveData);        
        // $user->save($userSaveData);
        
        if(empty($request->id))
        {
            $user->assignRole('staff');
        }
        
        return successResponse(['Message'=>'Success!', 'Data'=>[]]);
        return successResponse(['Message'=>'Success!', 'Data'=>[],'Redirect'=>route('view.staff',[$user->getRoleNames()->first()])]);
    }
    #----------------------------------------------------------------

    #----------------------------------------------------------------
    #Function to get User List
    public function getUserNameWithAvatar($name='',$image=NULL,$position=' ')
    {
        if($name=='')
            return $name;

        $Initials = getInitials($name);
        $randomState = getRandomColorState();
        $user_parent_profile = '<span class="avatar-content">'.$Initials.'</span>';
    
        $user_parent_profile = url_file_exists($image)?                
        '<img src="'.$image.'" alt="'.$name.'" height="32" width="32">':$user_parent_profile;
        
        $user_parent_profile = 
            '<div class="d-flex justify-content-left align-items-center">
                <div class="avatar-wrapper">
                    <div class="avatar  bg-light-'.$randomState.'  me-1">
                    '.$user_parent_profile.'
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a href="javascript:void(0);" class="user_name text-truncate text-body">
                    <span class="fw-bolder">'.ucwords($name).'</span>
                    </a>
                    <small class="emp_post text-muted">'. $position.'</small>
                </div>
            </div>';
        return $user_parent_profile;
    }
    #----------------------------------------------------------------

    public function editstaff(Request $request)
    {
        $Id = decrypt_to($request->id);

        $Data = Administrator::find($Id);
        
        if ($Data && isset($Data->email) && isset($Data->mobile)) {
            $Data->email = decrypt_to($Data->email);
            $Data->mobile = decrypt_to($Data->mobile);
        }
        if (!empty($Data->profile_picture)){
            $Data->profile_picture = url('public/upload/admin/'.$Data->profile_picture);
        }

        if(!$Data)
            return faildResponse(['Message' => 'Data not found!']);

  
        return successResponse(['Message' => 'Record Fetched Successfully!','Data'=>$Data]);
    }

    public function staffPasswordReset(Request $request,$id=0)
    {
        if($id==0)
            return response()->json([]);   

        $staff = Administrator::where('id', decrypt_to($id))->update(['password' => bcrypt('123456')]);     
        if($staff) 
            return successResponse(['Message' => 'Password Reseted Successfully!']);

        return faildResponse(['Message' => 'Something went wrong!']); 
    }

}