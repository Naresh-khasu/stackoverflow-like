<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class FacebookController extends Controller
{
    public function loginUsingFacebook()
    {
       return Socialite::driver('facebook')->redirect();
    }
    public function callbackFromFacebook()
    {
     try {
          $user = Socialite::driver('facebook')->user();

          $saveUser = User::updateOrCreate([
              'facebook_id' => $user->getId(),
          ],[
              'name' => $user->getName(),
              'email' => $user->getEmail(),
              'password' => Hash::make($user->getName().'@'.$user->getId())
               ]);

          Auth::loginUsingId($saveUser->id);

          return redirect()->route('home');
          } catch (\Throwable $th) {
             throw $th;
          }
      }
}
