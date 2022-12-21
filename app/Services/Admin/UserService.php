<?php
namespace App\Services\Admin;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserService{
    public static function store(RegisterRequest $request)
    {
        $user = new User();
        $user->fullname = $request->fullname;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
    }
    public function sort(Request $request)
    {
        if($request->ajax()){
            $sort_by = $request->sortBy;
            $type = $request->sortType;
            $users = User::orderBy($sort_by,$type)->paginate(10);
            return view('admin.inc.table_user',compact('users'))->render();
        }

    }
}
