<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'user_status' => 1])) {
            // Authentication passed...
            if((Auth::user()->roles->pluck('role_name')->contains('SUPERADMIN'))){
                return redirect(RouteServiceProvider::HOME);
            }else if((Auth::user()->roles->pluck('role_name')->contains('ADMIN'))){
                
                return redirect(RouteServiceProvider::ADMIN);
            }else{

                return redirect(RouteServiceProvider::USER);
            }
        }else{
            Auth::logout();
            return redirect('/');
        }

    }
}
