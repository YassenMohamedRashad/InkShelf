<div class="sticky top-0 z-50">
    <div class="flex gap-2 sm:gap-0 align-middle justify-between py-3 sm:navbar bg-white px-5 sticky top-0 z-10 ">
        <div class="w-auto sm:navbar-start">
            <div class="dropdown">
                <div class="drawer-content">
                    <label for="my-drawer" class="drawer-button btn bg-white">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>
                </div>
                <div
                    tabindex="0"
                    class="divide-y-4  space-y-2 shadow-xl menu menu-sm dropdown-content z-20 fixed top-0 left-0 rtl:right-0 bg-white text-black w-[300px] h-screen transform -translate-x-4 rtl:translate-x-4 transition-transform duration-300 ease-in-out menu-visible">

                    <div class="my-3">
                        <div class="text-center text-2xl flex place-content-center">
                            <x-app-logo />
                        </div>
                    </div>
                    <div class="divide-y-2">
                        <div class="my-3">
                            <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">categories : </div>
                            <ul class="">
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <a wire:navigate class="text-sm" href="">Books</a>
                                </li>
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <a wire:navigate class="text-sm" href="">Community</a>
                                </li>
                            </ul>
                        </div>
                        <div class="my-3">
                            <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">Settings : </div>
                            <ul class="">
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <details class="dropdown">
                                        <summary class="">Language <span class="text-orange-color">({{LaravelLocalization::getCurrentLocaleNative()}})</span></summary>
                                        <ul class="menu dropdown-content bg-gray-100 divide-y-2 space-y-1 z-[5] w-full p-2 shadow">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li>
                                                <a wire:navigate away rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </details>
                                </li>
                                @auth
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <a wire:navigate class="text-sm" href="">Profile</a>
                                </li>
                                <li class="p-2 bg-gray-100 hover:bg-orange-200 font-bold w-full">
                                    <form
                                        confirm="Logout"
                                        confirm-text="Are you sure you want to logout?"
                                        confirm-button="logout"
                                        cancel-button="cancel"
                                        action="{{ route('logout') }}" class="w-full">
                                        <input type="submit" value="logout" class="w-full text-sm text-red-600 hover:bg-gray-200 block m-0 p-0">
                                    </form>
                                </li>
                                @endauth


                            </ul>
                        </div>

                    </div>

                </div>

            </div>
            <a wire:navigate class="text-xl hidden sm:inline-flex" href="{{route('home')}}">
                <x-app-logo />
            </a>
        </div>

        <div class="w-full sm:navbar-end place-content-end">
            <div class="w-full relative">
                <form class="join w-full">
                    <livewire:actions.BooksLiveSearch class="w-full" />
                    <button type="submit" class="px-3 hover:bg-dark-orange transition join-item rounded-r-full bg-orange-color text-white border-orange-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                            <path fill="currentColor" d="M232.49 215.51L185 168a92.12 92.12 0 1 0-17 17l47.53 47.54a12 12 0 0 0 17-17ZM44 112a68 68 0 1 1 68 68a68.07 68.07 0 0 1-68-68" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="ms-3 hidden lg:block">
                <div class="flex items-center gap-3">
                    @auth
                    <div class="dropdown dropdown-end">
                        <div class="flex items-center justify-center w-[40px] h-[40px]">
                            <img tabindex="0" src="{{auth()->user()->image}}" role="button" class="w-full h-full rounded-full object-cover" />
                        </div>
                        <ul tabindex="0" class="dropdown-content menu divide-y-2 space-y-2 text-gray-900 bg-white rounded-lg z-[1] w-52 p-2 shadow">
                            <li>
                                <a wire:navigate class="hover:bg-gray-200 w-full" href="{{route('profile')}}">{{__('profile')}}</a>
                            </li>
                        </ul>
                    </div>

                    @else
                    <a wire:navigate href="{{route('login')}}" class="text-orange-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20zm2-2h12v-.8q0-.275-.137-.5t-.363-.35q-1.35-.675-2.725-1.012T12 15t-2.775.338T6.5 16.35q-.225.125-.363.35T6 17.2zm6-8q.825 0 1.413-.587T14 8t-.587-1.412T12 6t-1.412.588T10 8t.588 1.413T12 10m0 8" />
                        </svg>
                    </a>
                    @endauth
                    <div class="relative">
                        <span class="absolute top-[-5px] right-[-5px] rounded-full bg-orange-color w-4 h-4 text-center font-bold text-[10px] text-white place-content-center" v-text="state.shared.cart_count"></span>
                        <div class="">
                            <a wire:navigate href=" {{route('login')}}" class="text-orange-color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M6.15 6l2.4 5h7l2.75-5zM5.2 4h14.75q.575 0 .875.513t.025 1.037l-3.55 6.4q-.275.5-.737.775T15.55 13H8.1L7 15h11q.425 0 .713.288T19 16t-.288.713T18 17H7q-1.125 0-1.7-.987t-.05-1.963L6.6 11.6L3 4H2q-.425 0-.712-.288T1 3t.288-.712T2 2h1.625q.275 0 .525.15t.375.425zm3.35 7h7z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="drawer z-20">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                tabindex="0"
                class="divide-y-4  space-y-2 shadow-xl menu menu-sm dropdown-content z-20 fixed top-0 left-0 rtl:right-0 bg-white text-black w-[300px] h-screen transform -translate-x-4 rtl:translate-x-4 transition-transform duration-300 ease-in-out menu-visible">

                <div class="my-3">
                    <div class="text-center text-2xl flex place-content-center">
                        <x-app-logo />
                    </div>
                </div>
                <div class="divide-y-2">
                    <div class="my-3">
                        <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">categories : </div>
                        <ul class="">
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <a wire:navigate class="text-sm" href="">Books</a>
                            </li>
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <a wire:navigate class="text-sm" href="">Community</a>
                            </li>
                        </ul>
                    </div>
                    <div class="my-3">
                        <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">Settings : </div>
                        <ul class="">
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <details class="dropdown">
                                    <summary class="">Language <span class="text-orange-color">({{LaravelLocalization::getCurrentLocaleNative()}})</span></summary>
                                    <ul class="menu dropdown-content bg-gray-100 divide-y-2 space-y-1 z-[5] w-full p-2 shadow">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </details>
                            </li>
                            @auth
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <a wire:navigate class="text-sm" href="">Profile</a>
                            </li>
                            <li class="p-2 bg-gray-100 hover:bg-orange-200 font-bold w-full">
                                <form method="post" action="{{route('logout')}}">
                                    @csrf
                                    <input type="submit" value="logout" class="w-full text-sm text-red-600 hover:bg-gray-200 block m-0 p-0">
                                </form>
                            </li>
                            @endauth


                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
