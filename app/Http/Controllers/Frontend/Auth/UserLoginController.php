<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    //
    public function login()
    {
        return view('frontend.login');

    }
    public function handleLogin(Request $request)
    {
        $rules = [
            'email'=>'required',
            'password'=>'required',
        ];
        $messages = [
            'email.required'=>"Bạn chưa nhập email của bạn ",
            'password.required'=>"Bạn chưa nhập mật khẩu ",
        ];

        $this->validate($request,$rules,$messages);

        $isremember = false;
        if($request->remember){
            $isremember = true;
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$isremember))
        {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'failure'=>" Thông tin đăng nhập không chính xác ",
        ]);
    }

    public  function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect(route('frontend.home'));

    }

}
