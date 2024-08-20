<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Volt\Component;


new #[Layout('layouts.guest')] class extends Component
{
    use WithFileUploads; // Include the WithFileUploads trait

    public $image;
    public $birth_date;
    public $gender;
    public $phone_number;
    public $address;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function register(): void
    {

        $validated = $this->validate([
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $imageName = 'avatar_' . time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images/users/avatars', $imageName);
            $imagePath = 'storage/images/users/avatars/' . $imageName;
        }

        $validated['image'] = $imagePath;
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        event(new Registered($user));

        Auth::login($user);
        $this->redirect(route('verification.notice'));
    }
}

?>

<div>
    <a type="link" href="{{route('google_login')}}" class="flex items-center mb-5 bg-transparent hover:bg-orange-color hover:text-white transition w-full rounded-md py-2 px-3 border text-black">
        <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="20" viewBox="0 0 256 262">
            <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
            <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
            <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
            <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
        </svg>
        <span class="mx-2">|</span>
        <span>Continue with Google</span>
    </a>
    <div class="divider">OR</div>
    <form wire:submit.prevent="register" enctype="multipart/form-data">
        <div>
            <x-input-label for="name" :value="__('upload your image (optional)')" required />
            <x-file-input wire:model="image" id="image" class="" type="file"  name="image" />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" required />
            <x-text-input wire:model="name" id="name" class="" type="text" name="name" required autofocus autocomplete="name">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20 5.995h-1v12h1c1.103 0 2-.897 2-2v-8c0-1.102-.897-2-2-2" />
                        <path fill="currentColor" d="M17 17.995V4h2.995V2h-8v2H15v1.995H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h11V20h-3.005v2h8v-2H17zm-11-4v-4h9v4z" />
                    </svg>
                </x-slot:icon>
            </x-text-input>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" required />
            <x-text-input wire:model="email" id="email" class="" type="email" name="email" required autocomplete="username">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                    </svg>
                </x-slot:icon>
            </x-text-input>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" required />

            <x-text-input wire:model="password" id="password" class=""
                type="password"
                name="password"
                required autocomplete="new-password">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3 17h18q.425 0 .713.288T22 18t-.288.713T21 19H3q-.425 0-.712-.288T2 18t.288-.712T3 17m1-5.55l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T1 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T7 9.95t-.213.538t-.537.212H5.3l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T9 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .537.213T15 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T17 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T23 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35z" />
                    </svg>
                </x-slot:icon>
            </x-text-input>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class=""
                type="password"
                name="password_confirmation" required autocomplete="new-password">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3 17h18q.425 0 .713.288T22 18t-.288.713T21 19H3q-.425 0-.712-.288T2 18t.288-.712T3 17m1-5.55l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T1 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T7 9.95t-.213.538t-.537.212H5.3l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T9 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .537.213T15 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T17 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T23 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35z" />
                    </svg>
                </x-slot:icon>
            </x-text-input>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <div>
                <x-primary-button class="w-full text-center p-3">
                    <div wire:loading>
                        <span class="loading loading-spinner loading-md"></span>
                    </div>
                    <span wire:loading.remove>
                        {{ __('Register') }}
                    </span>
                </x-primary-button>
            </div>
            <div class="flex flex-col mt-2">
                @if (Route::has('login'))
                <a class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:ring-2 focus:ring-offset-2 focus:outline-none" href="{{ route('login') }}" wire:navigate>
                    {{ __("Already have email ?") }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
