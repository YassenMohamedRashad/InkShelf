<x-splade-data default="{ open: false }">
    <nav class="sticky top-0 w-full z-20 transition shadow bg-white">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <Link class="flex items-center rtl:space-x-reverse" href="{{ route('home') }}">
            <img src="{{ asset('images/logo/inkwell.png') }}" class="w-[30px] h-[30px]" alt="">
            <x-application-logo class="text-2xl" />
            </Link>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @auth

                <button type="button" class="flex text-sm bg-orange-color rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <img class="w-[40px] h-[40px] rounded-full" src="{{ auth()->user()->image }}" alt="user photo">
                </button>

                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 ">{{ auth()->user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate">{{ auth()->user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <Link href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">Profile</Link>
                        </li>
                        <li>
                            <x-splade-form
                                confirm="Logout"
                                confirm-text="Are you sure you want to logout?"
                                confirm-button="logout"
                                cancel-button="cancel"
                                action="{{ route('logout') }}" class="w-full inline">
                                <input type="submit" value="logout" class="w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-200">
                            </x-splade-form>
                        </li>
                    </ul>
                </div>
                @endauth
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

                @guest
                <x-splade-button type="link" href="{{route('login')}}">
                    Login
                </x-splade-button>
                @endguest
            </div>




            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="transition text-black bg-white text-left rtl:text-right space-y-2 md:space-y-0 divide-y-2 md:divide-none font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent" id="navbar-links">
                    <li class="md:self-center text-black">
                        <Link href="#" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 ">Books</Link>
                    </li>
                    <li class="md:self-center text-black">
                        <Link href="#" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 ">Community</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</x-splade-data>
