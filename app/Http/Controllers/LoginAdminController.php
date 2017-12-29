<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Eloquent\User;

class LoginAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *Tran Van My
     *25/09/2017
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()) {
          if(Auth::user()->permission == 1 || Auth::user()->permission == 2) {
            return redirect('admin/home-admin');
          }
        }

        // dd('what');
        return view('sites.loginadmin.index');
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
                return redirect('/admin/home-admin');
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
