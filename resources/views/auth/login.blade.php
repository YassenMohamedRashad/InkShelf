<x-auth-card>
    <x-auth-session-status class="mb-4" />
    <x-splade-button away type="link" href="{{route('google_login')}}" class="flex items-center mb-5 bg-transparent hover:bg-orange-color hover:text-white transition" away>
        <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="20" viewBox="0 0 256 262">
            <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
            <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
            <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
            <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
        </svg>
        <span class="mx-2">|</span>
        <span>Continue with Google</span>
    </x-splade-button>
    <div class="divider">OR</div>

    <x-splade-form action="{{ route('login') }}" class="space-y-4">
        <!-- Email Address -->
        <label for="">

            <x-splade-input id="email" type="email" name="email" :label="__('Email')" class="grow" required autofocus>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                    </svg>
                </x-slot:icon>
            </x-splade-input>
        </label>
        <Link href="/" confirm>Hello</Link>
        <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="current-password">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                        <path stroke-linecap="round" d="M12 10v4m-1.732-3l3.464 2m0-2l-3.464 2m-3.535-3v4M5 11l3.464 2m0-2L5 13m12.268-3v4m-1.732-3L19 13m0-2l-3.465 2" />
                    </g>
                </svg>
            </x-slot:icon>

        </x-splade-input>
        <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />

        <div>
            <x-splade-submit :label="__('Log in')" class="w-full" />
            <Link href="{{route('register')}}" class="underline text-sm text-gray-400 hover:text-gray-900">
            {{__("Doesn't have email ?")}}
            </Link>
            <br>
            @if (Route::has('password.request'))
            <Link class="underline text-sm text-gray-400 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password ?') }}
            </Link>
            @endif
        </div>
    </x-splade-form>
</x-auth-card>
