<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index(Request $request)
    {
        $title = "Danh sách người dùng";

        if($request->search){
            $users = User::where('fullname','like',"%$request->search%")->paginate(10);
        }
        else{
            $users = User::paginate(10);
        }
        return view('admin.users.index', compact('title', 'users'));
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $title = "Cấp quyền người dùng ";
        return view('admin.users.edit', compact('title', 'user'));
    }

    public function handleEdit(Request $request, int $id)
    {
        $user = User::find($id);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', "Updated successfully");

    }

    public function delete_user(int $id)
    {
        User::destroy($id);
        return back()->with('success', "Delete succesfully!");
    }

    public function create()
    {
        $title = "Thêm người dùng";
        return view('admin.users.add', compact('title'));
    }

    public function store(RegisterRequest $request)
    {

        $user = new User();
        $user->fullname = $request->fullname;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', "Created");
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
