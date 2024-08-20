<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('social_id', $google_user->getId())->first();
            if (!$user) {
                $user = User::create([
                    'social_id' => $google_user->getId(),
                    'image' => $google_user->getAvatar(),
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'email_verified_at' => now()
                ]);
                Auth::login($user);
            } else {
                Auth::login($user);
            }
            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
