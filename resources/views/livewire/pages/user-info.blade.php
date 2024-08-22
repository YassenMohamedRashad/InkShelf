<div class="min-h-[90vh] flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">
    <style>
        .custom-radio:focus-visible {
            outline: none;
            box-shadow: none;
            /* Removes the blue focus ring */
        }
    </style>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div>
            <form wire:submit="save">
                <div class="mb-5">
                    <x-input-label for="address" :value="__('Address')" class="mb-1" required />
                    <x-text-input wire:model.blur="address" id="address" type="text" name="address" required autofocus autocomplete="username">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 9.3V4h-3v2.6L12 3L2 12h3v8h5v-6h4v6h5v-8h3zm-9 .7c0-1.1.9-2 2-2s2 .9 2 2z" />
                            </svg>
                        </x-slot>
                    </x-text-input>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <x-input-label for="phone_number" :value="__('Phone number')" class="mb-1" required />
                    <x-text-input wire:model.blur="phone_number" id="phone_number" type="text" name="phone_number" required autofocus autocomplete="username">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                            </svg>
                        </x-slot>
                    </x-text-input>
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>


                <div class="mb-5">
                    <x-input-label for="birth_date" :value="__('Birth date')" class="mb-1" required />
                    <div class="flex items-center rounded-md border border-gray-300 shadow-sm">
                        <div>
                            <span class="flex items-center px-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 16H5V10h14zM9 14H7v-2h2zm4 0h-2v-2h2zm4 0h-2v-2h2zm-8 4H7v-2h2zm4 0h-2v-2h2zm4 0h-2v-2h2z" />
                                </svg>
                            </span>
                        </div>
                        <div class="w-full">
                            <input wire:model.blur="birth_date" class='py-3 text-black w-full border-0 focus:ring focus:ring-orange-color focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded h-full pl-2 leading-none' type="date" />
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>


                <div>
                    <x-input-label for="gender" :value="__('Gender')" class="mb-1" required />
                    <div class="flex gap-5">
                        <div>
                            <input wire:model.blur="gender" type="radio" name="gender" id="gender" value="male" class="radio border-orange-color checked:bg-orange-color checked:outline-none checked:ring-orange-color" />
                            <x-input-label :value="__('male')" class="ms-1 inline" />
                        </div>
                        <div>
                            <input type="radio" wire:model.blur="gender" name="gender" id="gender" value="female" class="radio border-orange-color checked:bg-orange-color checked:outline-none checked:ring-orange-color" />
                            <x-input-label :value="__('female')" class="ms-1 inline" />
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>



                <div class="mt-4">
                    <div>
                        <x-primary-button class="w-full text-center p-3">
                            <div wire:loading>
                                <span class="loading loading-spinner loading-md"></span>
                            </div>
                            <span wire:loading.remove>
                                {{ __('Save') }}
                            </span>
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
