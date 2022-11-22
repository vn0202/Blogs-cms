<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
    public function  index(){

        return view('admin.login');
    }
    public  function  handle(Request $request){
        $this->validate($request,[
           'email'=>"required",
           'password'=>"required"
        ],
        [
            'email.required'=>"Bạn chưa nhập email của bạn ",
            'password.required'=>"Bạn chưa nhập mật khẩu "
        ]);


        //handle if user choose remember
        $isremember = false;
     if($request->remember){
         $isremember = true;
     }

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$isremember))
        {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }
        return back()->withErrors([
            'failure'=>" Thông tin đăng nhập không chính xác ",
        ]);
    }
    public  function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect(route('login'));

    }
}
