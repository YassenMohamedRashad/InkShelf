<x-splade-data default="{ open: false }">



    <nav class="bg-transparent fixed top-0 w-full">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <Link class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold">InkShelf</span>
            </Link>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">

                    <li>
                        <Link href="#" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 text-white">Books</Link>
                    </li>
                    <li>
                        <Link href="#" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 text-white">Community</Link>
                    </li>
                    <li>
                        <Link href="{{route('login')}}" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 text-white">Login</Link>
                    </li>
                    <li>
                        <Link href="{{route('register')}}" class="block py-2 px-3 rounded hover:text-gray-200 md:border-0 md:p-0 text-white">Register</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



</x-splade-data>
