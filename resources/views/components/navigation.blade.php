<x-splade-data default="{ query: '', results: [] }">
    <div class="flex gap-2 sm:gap-0 align-middle justify-between py-3 sm:navbar bg-white px-5 sticky top-0">
        <div class="w-auto sm:navbar-start">
            <div class="dropdown">
                <div class="drawer-content">
                    <label for="my-drawer" class="drawer-button btn">
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
                            <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
                            <x-application-logo />
                        </div>
                    </div>
                    <div class="divide-y-2">
                        <div class="my-3">
                            <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">categories : </div>
                            <ul class="">
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <Link class="text-sm" href="">Books</Link>
                                </li>
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <Link class="text-sm" href="">Community</Link>
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
                                                <Link away rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                                </Link>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </details>
                                </li>
                                @auth
                                <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                    <Link class="text-sm" href="">Profile</Link>
                                </li>
                                <li class="p-2 bg-gray-100 hover:bg-orange-200 font-bold w-full">
                                    <x-splade-form
                                        confirm="Logout"
                                        confirm-text="Are you sure you want to logout?"
                                        confirm-button="logout"
                                        cancel-button="cancel"
                                        action="{{ route('logout') }}" class="w-full">
                                        <input type="submit" value="logout" class="w-full text-sm text-red-600 hover:bg-gray-200 block m-0 p-0">
                                    </x-splade-form>
                                </li>
                                @endauth


                            </ul>
                        </div>

                    </div>

                </div>

            </div>
            <Link class="btn text-xl hidden sm:inline-flex" href="{{route('home')}}">
            <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
            <x-application-logo />
            </Link>
        </div>

        <div class="w-full sm:navbar-end place-content-end">
            <div class="w-full relative">
                <form class="join w-full">
                    <input type="text" id="search-input" name="query" class="border-orange-color focus:ring-0 join-item w-full focus:border-dark-orange" placeholder="{{__('search for books , categories , ISBN .....')}}" />
                    <x-books-live-search input="search-input" containerId="nav-search"/>
                    <button type="submit" class="px-3 hover:bg-dark-orange transition join-item rounded-r-full bg-orange-color text-white border-orange-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                            <path fill="currentColor" d="M232.49 215.51L185 168a92.12 92.12 0 1 0-17 17l47.53 47.54a12 12 0 0 0 17-17ZM44 112a68 68 0 1 1 68 68a68.07 68.07 0 0 1-68-68" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="ms-3 hidden lg:block">
                @auth
                <div class="dropdown dropdown-end">
                    <img tabindex="0" src="{{auth()->user()->image}}" role="button" class="w-10 h-10 rounded-full" />
                    <ul tabindex="0" class="dropdown-content menu divide-y-2 space-y-2 text-gray-900 bg-white rounded-lg z-[1] w-52 p-2 shadow">
                        <li>
                            <Link class="hover:bg-gray-200 w-full" href="{{route('profile.edit')}}">{{__('profile')}}</Link>
                        </li>
                    </ul>
                </div>
                @else
                <Link href="{{route('login')}}" class="text-orange-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5.85 17.1q1.275-.975 2.85-1.537T12 15t3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4T6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5t1.013-2.488T12 6t2.488 1.013T15.5 9.5t-1.012 2.488T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                </svg>
                </Link>
                @endauth
            </div>
        </div>
    </div>



    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                tabindex="0"
                class="divide-y-4  space-y-2 shadow-xl menu menu-sm dropdown-content z-20 fixed top-0 left-0 rtl:right-0 bg-white text-black w-[300px] h-screen transform -translate-x-4 rtl:translate-x-4 transition-transform duration-300 ease-in-out menu-visible">

                <div class="my-3">
                    <div class="text-center text-2xl flex place-content-center">
                        <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
                        <x-application-logo />
                    </div>
                </div>
                <div class="divide-y-2">
                    <div class="my-3">
                        <div class="text-lg font-bold w-[90%] m-auto bg-gray-100 rounded">categories : </div>
                        <ul class="">
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <Link class="text-sm" href="">Books</Link>
                            </li>
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <Link class="text-sm" href="">Community</Link>
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
                                            <Link away rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                            </Link>
                                        </li>
                                        @endforeach
                                    </ul>
                                </details>
                            </li>
                            @auth
                            <li class="p-2 bg-gray-100 hover:bg-orange-200  font-bold">
                                <Link class="text-sm" href="">Profile</Link>
                            </li>
                            <li class="p-2 bg-gray-100 hover:bg-orange-200 font-bold w-full">
                                <x-splade-form
                                    confirm="Logout"
                                    confirm-text="Are you sure you want to logout?"
                                    confirm-button="logout"
                                    cancel-button="cancel"
                                    action="{{ route('logout') }}" class="w-full">
                                    <input type="submit" value="logout" class="w-full text-sm text-red-600 hover:bg-gray-200 block m-0 p-0">
                                </x-splade-form>
                            </li>
                            @endauth


                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>



</x-splade-data>
