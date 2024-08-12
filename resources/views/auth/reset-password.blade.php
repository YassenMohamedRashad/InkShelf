<x-guest-layout>
    <x-auth-card>
        <x-splade-form :default="['email' => $request->email, 'token' => $request->route('token')]" action="{{ route('password.store') }}" class="space-y-4">
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required autofocus>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                    </svg>
                </x-slot:icon>
            </x-splade-input>
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                            <path stroke-linecap="round" d="M12 10v4m-1.732-3l3.464 2m0-2l-3.464 2m-3.535-3v4M5 11l3.464 2m0-2L5 13m12.268-3v4m-1.732-3L19 13m0-2l-3.465 2" />
                        </g>
                    </svg>
                </x-slot:icon>
            </x-splade-input>
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required>
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12Z" />
                            <path stroke-linecap="round" d="M12 10v4m-1.732-3l3.464 2m0-2l-3.464 2m-3.535-3v4M5 11l3.464 2m0-2L5 13m12.268-3v4m-1.732-3L19 13m0-2l-3.465 2" />
                        </g>
                    </svg>
                </x-slot:icon>
            </x-splade-input>

            <div class="flex items-center justify-end">
                <x-splade-submit :label="__('Reset Password')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
