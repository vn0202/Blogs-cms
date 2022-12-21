<?php

namespace App\Http\Middleware\Admin;

use App\Models\PostTags;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorOrAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request,  Closure $next, int $id)
    {
        if(Auth::check() && (Auth::user()->role == 1 || Post::find($id)->author->role == Auth::user()->role ))
            return $next($request);
        else{
            return back()->withErrors(
                [
                    'nopermission'=>"Bạn không có quyền truy cập vào tài nguyên này!",
                ]
            );
        }

    }
}
