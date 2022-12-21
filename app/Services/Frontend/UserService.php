<?php


namespace  App\Frontend;
use App\Http\Requests\Auth\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserService {
    public static  function save(UpdateUserRequest $request){
        $user = Auth::user();
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
    }

}
