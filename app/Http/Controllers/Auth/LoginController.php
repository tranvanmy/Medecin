<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\User;

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
    protected $redirectTo = '/';

    /**
     * Pham Viet Toan
     * 23/09/2017
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required|string',
        ]);
    }

    /**
     * Pham Viet Toan
     * 09/23/2017
     * Override function get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'id';
    }
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
     * Tran Van My
     * 25/09/2017
     * Check Login Admin
     * @param
     * @return boolean
     */
    public function postLogin(Request $request)
    {   
        $email = $request->email;
        $password = $request->password;
        $remember = $request->input('remember');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)){
            if((Auth::user()->permission) == 1 || (Auth::user()->permission) == 2) {
                return redirect('/admin/user');
            } elseif((Auth::user()->permission) == 3) {
                Auth::logout();
                session()->flash('message', trans('message.user_disable'));

                return redirect('/dangnhap-admin');
            }
        } else {
            $message = trans('sites.mess');
            session()->flash('message', trans('message.incorrect_username_or_pass'));

            return redirect('/dangnhap-admin');
        }
    }
}
