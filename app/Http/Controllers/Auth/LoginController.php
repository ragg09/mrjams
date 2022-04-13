<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Clinic_time_availability;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;

use Laravel\Sanctum\HasApiTokens;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, HasApiTokens;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //Google Callback
    public function handleGoogleCallBack()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        $user_table = User::where('email', '=',  Auth::user()->email)->first();
        $user_as_customer = User_as_customer::Where('users_id', '=',  $user_table->id)->first();
        $user_as_clinic = User_as_clinic::Where('users_id', '=',  $user_table->id)->first();

        //RETURN ROUTE LOGIC
        if (!$user_as_customer && !$user_as_clinic) {
            if (Auth::user()->email == env('GOOGLE_ACCOUNT_EMAIL')) {
                return redirect('/admin');
            } else {
                return redirect('/role');
            }
        } else {
            if (Auth::user()->email == env('GOOGLE_ACCOUNT_EMAIL')) {
                return redirect('/admin');
            }

            if ($user_table->role == "clinic") {
                return redirect('/clinic');
            }

            if ($user_table->role == "customer") {
                return redirect('/customer');
                // $this_user = User::where("id", $user_as_customer->users_id)->first();

                // //$token = $logged ->createToken($request->token_name);
                // $token = $this_user->createToken('token')->plainTextToken;

                // echo $token;
            }
        }
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=',  $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->email = $data->email;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
