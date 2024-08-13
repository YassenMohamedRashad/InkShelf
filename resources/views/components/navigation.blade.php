<x-splade-data default="{ open: false }">
    <div class="navbar bg-white">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost">
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
                </div>
                <div
                    tabindex="0"
                    class="divide-y-4  space-y-2 shadow-xl menu menu-sm dropdown-content z-20 fixed top-0 left-0 rtl:right-0 bg-white text-black w-[300px] h-screen transform -translate-x-4 rtl:translate-x-4 transition-transform duration-300 ease-in-out menu-visible">

                    <div class="my-3">
                        <div class="text-center text-2xl flex place-content-center">
                            <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
                            <x-application-logo class="" />
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
                                        <ul class="menu dropdown-content bg-gray-300 rounded-box z-[5] w-52 p-2 shadow">
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
            <Link class="btn btn-ghost text-xl" href="{{route('home')}}">
            <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
            <x-application-logo />
            </Link>
        </div>

        <div class="navbar-end">
            <a class="btn">Button</a>
        </div>
    </div>



</x-splade-data>
