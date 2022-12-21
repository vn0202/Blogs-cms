<?php

namespace  App\Services\Admin;

use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService{
    public static function save(UpdateUserRequest $request)
    {
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
    }
}
