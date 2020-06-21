<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
date_default_timezone_set("Asia/Jakarta");

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username=$this->findUsername();
    }

    public function findUsername()
    {
        // dd(request()->all());
        $login=request()->input('login');
        $fieldType=filter_var($login,FILTER_VALIDATE_EMAIL)?'email':'username';
        request()->merge([$fieldType=>$login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function authenticated(Request $request, $user)
    {
        // dd($user);
        // dd($user);
        // if(!$user->verified)
        // {
        //     auth()->logout();
        //     return back()->with('warning','You need to confirm your account. We have sent you an activation code, please check your email.');
        // }
        if(!$user->verified)
        {
            auth()->logout();
            message(false,'','Akun anda sudah diblokir!');
            // return back()->with('warning','You need to confirm your account. We have sent you an activation code, please check your email.');
            return back();

        }

        message(true,'User '.\Auth::user()->name.' berhasil login pada '.date('d-m-Y H:i:s'));
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        // message(true,'Anda berhasil logout dari sistem!','');
        return redirect('/');
    }
}
