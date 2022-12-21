<?php

namespace App\Http\Controllers\Frontend;

use App\Frontend\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateUserRequest;
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
    public function handle(UpdateUserRequest $request){
            UserService::save($request);
        return back()->with('success','updated');
    }


}
