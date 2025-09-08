<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Administrator;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminLoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    // Function for open login form ---------------
    public function index($is_adminLogin = '')
    {
        $file['title'] = '';
        $file['loginFormData'] = [
            'name' => 'login-form',
            'action' => route('login'),
            'method' => 'post',
            'submit' => 'login',
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'label' => 'Email Id',
                    'name' => 'email',
                    'validation' => 'required',
                ],
                [
                    'tag' => 'input',
                    'type' => 'password',
                    'label' => 'password',
                    'name' => 'password',
                    'validation' => 'required',
                ]
            ],
        ];
        session(['is_adminLogin' => ($is_adminLogin != '' ? $is_adminLogin : false)]);
        return view(($is_adminLogin != '' ? 'auth.AdminLogin' : 'auth.login'), $file);
    }


    public function login(AdminLoginRequest $request)
    {

        if (RateLimiter::tooManyAttempts($this->throttleKey(), 4)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            return faildResponse(['Message' => 'Validaiton Warning', 'Data' => ['email' => ['Too many login attempts! ' . 'Contect your admin!']]]);
        }

        $credentials = $request->getCredentials();
        $credentials['email'] = encrypt_to($credentials['email']);

        // Attempt to log in the user
        if (Auth::guard('admin')->attempt($credentials) && Auth::guard('admin')->user()->user_status == 'active') {

            if (session()->get('is_adminLogin') && !Auth::guard('admin')->user()->hasRole('supperadmin')) {
                Auth::guard('admin')->logout();
                return faildResponse(['Message' => 'Validaiton Warning', 'Data' => ['email' => ['Your Account Not Found!']]]);

            } elseif (!session()->get('is_adminLogin') && Auth::guard('admin')->user()->hasRole('supperadmin')) {
                dd(Auth::guard('admin')->user()->hasRole(roles: 'supperadmin'));
                Auth::guard('admin')->logout();
                return faildResponse(['Message' => 'Validaiton Warning', 'Data' => ['email' => ['Your Account Not Found!']]]);
            }

            Auth::guard('admin')->logoutOtherDevices($credentials['password']);

            Auth::guard('admin')->user()->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);

            RateLimiter::clear($this->throttleKey());
            return successResponse(['Message' => 'Success!', 'Data' => [], 'Redirect' => route('admin.dashboard')]);
        }

        RateLimiter::hit($this->throttleKey());
        $error = ['email' => ['Invalid Email Id or Password!']];
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->user_status != 'active')
                $error = ['email' => ['Your account has been disabled!']];
            Auth::guard('admin')->logout();
        }
        return faildResponse(['Message' => 'Validaiton Warning', 'Data' => $error]);
    }

    public function ShowRegistration(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
            return redirect()->route('showuserregister');
        }

        $file['title'] = 'register';
        $file['loginFormData'] = [
            'name' => 'login-form',
            'action' => route('showuserregister'),
            'method' => 'post',
            'submit' => 'Register',
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'label' => 'name',
                    'name' => 'name',
                    'validation' => 'required',
                    'grid' => 12,
                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'label' => 'mobile',
                    'name' => 'mobile',
                    'validation' => 'required',
                    'grid' => 12,
                ],
                [
                    'tag' => 'input',
                    'type' => 'email',
                    'label' => 'email',
                    'name' => 'email',
                    'validation' => 'required',
                    'grid' => 12,
                ],
                [
                    'tag' => 'input',
                    'type' => 'password',
                    'label' => 'password',
                    'name' => 'password',
                    'validation' => 'required',
                ],
            ],
        ];
        return view('auth.Register', $file);

    }

    protected function Registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
            return faildResponse(['Message' => 'Validaiton Warning', 'Data' => $validator->errors()->toArray()]);


        $user = Administrator::create([
            'name' => $request['name'],
            'mobile' => encrypt_to($request['mobile']),
            'username' => str_replace(' ', '', $request['name']),
            'usercode' => $request['mobile'],
            'email' => encrypt_to($request['email']),
            'password' => bcrypt($request['password']),
        ]);
        $usercode = strlen($user->id) >= 6 ? $user->id : (str_pad(rand(1, 9999), (6 - (strlen($user->id) > 6 ? 6 : strlen($user->id))), '0', STR_PAD_RIGHT)) . $user->id;

        $user->assignRole('admin');

        return successResponse(['Message' => 'Success!', 'Data' => [], 'Redirect' => route('auth-login')]);
    }

    function numberToCharacterString($number)
    {
        $numberStr = strval($number);
        $result = '';
        for ($i = 0; $i < strlen($numberStr); $i++) {
            $digit = intval($numberStr[$i]);
            if ($digit >= 0 && $digit <= 26) {
                // Assuming you want to convert 1 to 'A', 2 to 'B', and so on
                $result .= chr(ord('A') + $digit);
            }
        }
        return $result;
    }
    #----------------------------------------------------------------
    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return request('userid');
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function checkTooManyFailedAttempts()
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return faildResponse(['Message' => 'Validaiton Warning', 'Data' => ['userid' => ['Too many login attempts!']]]);
        }

    }

    /**
     * Clear Login limite  Attempts .
     *
     * @return void
     */
    public function clearLoginAttempts()
    {
        RateLimiter::clear($this->throttleKey());
    }

    // use Auth;
    public function logout()
    {
        $is_adminLogin = session()->get('is_adminLogin');
        $user = Auth::guard('admin')->user();
        session()->forget(['admin', 'staff', 'supperadmin']);

        session()->flush();
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if ($user && $user->hasRole(['supperadmin'])) {
            return redirect()->route('auth-login', ['is_adminLogin' => $is_adminLogin ?? '']);
        }
        return redirect('/admin');
    }
}
