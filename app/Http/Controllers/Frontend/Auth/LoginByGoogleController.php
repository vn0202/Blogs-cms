<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
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

            $user = User::where('google_id',$google_user->getId())->get();
            if(!$user){
               $new_user = User::create([
                   'fullname'=>$google_user->getName(),
                   'name'=>$google_user->getNickname(),
                   'email'=>$google_user->getEmail(),
                   'google_id'=>$google_user->getId(),
                   'avatar'=>$google_user->getAvatar(),
               ]);
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
