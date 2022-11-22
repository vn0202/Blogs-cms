<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view("frontend.edit",compact('user'));
    }
    public function handle(Request $request){
        $user = Auth::user();

        $rules = [
            'fullname'=>['required'],
            'username'=>['required',Rule::unique('users','name')->ignore($user->id)],
            'email'=>['required',Rule::unique('users')->ignore($user->id)],
            'password'=>['required',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'password_confirmation' => 'same:password',
            'avatar'=>['nullable','image'],

        ];
        $messages = [
            '*.required'=>"Bạn chưa nhập :attribute",
            '*.min'=>":attribute tối thiểu :min ký tự",
            '*.max' =>":attribute tối đa :max ký tự",
            '*.unique'=>":attribute đã tồn tại ",
            "email.email"=>"email không đúng đinh dạng ",
            'password_confirmation'=>"Xác nhận mật khẩu không đúng",
            'avatar.image'=>'Chỉ hỗ trợ định dạng hình ảnh',
        ];
        $attributes =  [
            'fullname'=>"Tên đầy đủ",
            'username'=>'Tên đăng nhập',
            'password'=>"Mật khẩu của bạn ",
            'password_confirmation'=> "xác nhận mật khẩu",
        ];
        $this->validate($request,$rules,$messages,$attributes);
            $user->fullname = $request->fullname;
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
        if($request->hasFile('avatar')) {

            $extension = pathinfo($request->file('avatar')->getClientOriginalName(),PATHINFO_BASENAME);
            $avatar = $request->username . time() . '.' . $extension;
            $path = $request->avatar->storeAs('public/avatar', $avatar);
            $user->avatar = "storage/avatar/". $avatar;

        }
        $user->save();
        return back()->with('success','updated');
    }


}
