<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */


    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('verification.notice'));
    }
}; ?>

<div class="min-h-[90vh] flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
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
        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="mb-1" required />
                <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7.175q.125 0 .263-.038t.262-.112L19.6 8.25q.2-.125.3-.312t.1-.413q0-.5-.425-.75T18.7 6.8L12 11L5.3 6.8q-.45-.275-.875-.012T4 7.525q0 .25.1.438t.3.287l7.075 4.425q.125.075.263.113t.262.037" />
                        </svg>
                    </x-slot>
                </x-text-input>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" required />

                <x-text-input wire:model="form.password" id="password"
                    showpass
                    type="password"
                    name="password"
                    required autocomplete="current-password">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M3 17h18q.425 0 .713.288T22 18t-.288.713T21 19H3q-.425 0-.712-.288T2 18t.288-.712T3 17m1-5.55l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T1 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T7 9.95t-.213.538t-.537.212H5.3l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T9 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .537.213T15 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35zm8 0l-.475.85q-.15.275-.45.35t-.575-.075t-.35-.45t.075-.575l.475-.85h-.95q-.325 0-.537-.212T17 9.95t.213-.537t.537-.213h.95l-.475-.8q-.15-.275-.075-.575t.35-.45t.575-.075t.45.35l.475.8l.475-.8q.15-.275.45-.35t.575.075t.35.45t-.075.575l-.475.8h.95q.325 0 .538.213T23 9.95t-.213.538t-.537.212h-.95l.475.85q.15.275.075.575t-.35.45t-.575.075t-.45-.35z" />
                        </svg>
                    </x-slot>
                </x-text-input>

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-orange-color shadow-sm focus:ring-0 focus:outline-none" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mt-4">
                <div>
                    <x-primary-button class="w-full text-center p-3">
                        <div wire:loading>
                            <span class="loading loading-spinner loading-md"></span>
                        </div>
                        <span wire:loading.remove>
                            {{ __('Log in') }}
                        </span>
                    </x-primary-button>
                </div>
                <div class="flex flex-col mt-2">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:ring-2 focus:ring-offset-2 focus:outline-none" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    @if (Route::has('register'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:ring-2 focus:ring-offset-2 focus:outline-none" href="{{ route('register') }}" wire:navigate>
                        {{ __("Doesn't have account ?") }}
                    </a>
                    @endif
                </div>

            </div>
        </form>
    </div>
</div>
