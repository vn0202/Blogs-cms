<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginByGoogleController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id',$google_user->getId())->first();
            if(!$user){
                //check whether this email have registered
                //if it has registered, update its google_id
                $new_user =User::where('email',$google_user->getEmail())->first();
                if($new_user)
                {
                    $new_user->google_id = $google_user->getId();
                    $new_user->save();
                }
                //if not, register a new user
                else{
                    $new_user = new User();
                    $new_user->fullname = $google_user->getName();
                    $new_user->name = $google_user->getName();
                    $new_user->email = $google_user->getEmail();
                    $new_user->avatar = $google_user->getAvatar();
                    $new_user->google_id = $google_user->getId();
                    $new_user->save();
                }

                Auth::login($new_user);
                return redirect()->route('frontend.home');
            }
            else{
                Auth::login($user);
                return redirect()->route('frontend.home');
            }


        } catch (\Throwable $th) {
        }
    }


}
