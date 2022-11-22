<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    //
    public function index(){
        return view('admin.register');
    }
    public function handle(RegisterRequest $request){

    $user = new User();
    $user->fullname = $request->fullname;
    $user->name = $request->username;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->avatar = "asset/admin/dist/img/user2-160x160.jpg";
    $user->save();
    return redirect(route('login'));
    }
}
