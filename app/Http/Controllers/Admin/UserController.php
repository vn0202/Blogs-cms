<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

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

    public function update(int $id)
    {
        $user = User::find($id);
        $title = "Cấp quyền người dùng ";
        return view('admin.users.edit', compact('title', 'user'));
    }

    public function save(Request $request, int $id)
    {
        $user = User::find($id);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', "Updated successfully");

    }

    public function delete(int $id)
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

         UserService::store($request);
        return back()->with('success', "Created");
    }



}
