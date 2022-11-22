<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    //

    public function index()
    {

        $title = "Dashboard";
        $user = Auth::user();
        return view('admin.index', compact('title', 'user'));
    }

    public function editor()
    {
        $title = "Chỉnh sửa thông tin cá nhân";
        $user = Auth::user();
        return view('admin.edit', compact('title', 'user'));
    }
    public function handleEdit( Request $request)
    {
        $rules = ['fullname'=>['required','min:12','max:60','regex:/[^\d]+/'],
            'username'=>['required',Rule::unique('users','name')->ignore(Auth::id()),'min:6','max:32'],
            'email'=>['required','email',Rule::unique('users')->ignore(Auth::id())],
            'password'=>['required',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
            'password_confirmation' => 'same:password',
        ];

        if($request->hasFile('avatar')){
            $rules = [...$rules,"avatar"=>File::image()->max(20*1024)];
        }
        $this->validate($request,$rules,
        [
            'avatar.image'=>"Chỉ hỗ trợ định dạng file image",
            'avatar.max'=>"Kích thước file của bạn quá lớn",
            'password_confirmation.same'=>"Mật khẩu xác thực của bạn không khớp",
            '*.required'=>"Bạn chưa nhập :attribute",
            '*.min'=>":attribute tối thiểu :min ký tự",
            '*.max' =>":attribute tối đa :max ký tự",
            '*.unique'=>":attribute đã tồn tại ",
            "email.email"=>"email không đúng đinh dạng ",
            'password_confirmation'=>"Xác nhận mật khẩu không đúng",
        ]);
        $user = User::find(Auth::id());

        if($request->hasFile('avatar')) {

            $extension = pathinfo($request->file('avatar')->getClientOriginalName(),PATHINFO_BASENAME);
            $avatar = $request->username . time() . '.' . $extension;
            $path = $request->avatar->storeAs('public/avatar', $avatar);
            $user->avatar = "storage/avatar/". $avatar;

        }
        $user->fullname = $request->fullname;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
     return back()->with('success',"Updated ");
    }





}
