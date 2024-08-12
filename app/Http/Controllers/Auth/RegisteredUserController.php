<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUser $request)
    {
        // Initialize the image path to null
        $imagePath = null;

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            // Generate a unique name for the image using the current date and time
            $imageName = 'avatar_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            // Store the image in the 'public/images' directory with the generated name
            Storage::putFileAs('public/images/users/avatars', $request->file('image'), $imageName);
            $imagePath = asset('storage/images/users/avatars/' . $imageName);
        }

        // Create the user with the image path
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        // // Log in the user
        Auth::login($user);

        // Redirect to the dashboard
        return redirect()->route('home');
    }


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
