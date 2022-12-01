<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginByFaceBookController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {

        try {
            $facebooker = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $facebooker->getId())->first();
            if(!$user)
            {
                //check the email that whether email had registered
                $new_user = User::where('email',$facebooker->getEmail())->first();
                //if it has been registered, save addition facebook_id
                if($new_user)
                {
                    $new_user->facebook_id = $facebooker->getId();
                    $new_user->save();

                }
                //eslse register new user
                else{
                    $new_user = new User();
                    $new_user->fullname = $facebooker->getName();
                    $new_user->name = $facebooker->getName();
                    $new_user->email = $facebooker->getEmail();
                    $new_user->avatar = $facebooker->getAvatar();
                    $new_user->facebook_id = $facebooker->getId();
                    $new_user->save();

            }
                Auth::login($new_user);
                return redirect()->route('frontend.home');
            }
            else {
                Auth::login($user);
                return redirect()->route('frontend.home');
            }
        }
        catch (\Exception $exception)
        {
           dd( $exception->getMessage());
        }

    }
}
