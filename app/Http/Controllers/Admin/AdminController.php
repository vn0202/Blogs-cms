<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\AdminService;
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

    public function update()
    {
        $title = "Chỉnh sửa thông tin cá nhân";
        $user = Auth::user();
        return view('admin.edit', compact('title', 'user'));
    }
    public function save(UpdateUserRequest $request)
    {

     AdminService::save($request);
     return back()->with('success',"Updated ");
    }





}
