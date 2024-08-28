<div class="sticky top-0 z-50">
    <div class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between py-3 sm:navbar bg-white px-5 sticky top-0 z-10 ">
        <div class="w-auto navbar-start flex items-center sm:justify-center">
            <div class="dropdown">
                <div class="drawer-content mx-4 hover:text-orange-color">
                    <label for="my-drawer" class="drawer-button bg-white hover">
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
            </div>
            <div>
                <a wire:navigate class="text-xl inline-flex" href="{{route('home')}}">
                    <x-app-logo />
                </a>
            </div>
        </div>

        <div class="w-full navbar-end place-content-end sm:max-w-[75%]">
            <div class="w-full relative">
                <form class="join w-full" wire:submit.prevent="search">
                    <livewire:actions.BooksLiveSearch class="w-full" name="search-term"/>
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
                        <div class="flex items-center justify-center w-[35px] h-[35px]">
                            <img tabindex="0" src="{{auth()->user()->image??asset('images/other/account_demo.png')}}" role="button" class="w-full h-full rounded-full object-cover" />
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
                        @if ($user_cart_count > 0)
                        <span class="absolute top-[-5px] right-[-5px] rounded-full bg-orange-color w-4 h-4 text-center font-bold text-[10px] text-white place-content-center" v-text="state.shared.cart_count">{{$user_cart_count}}</span>
                        @endif
                        <div class="">
                            <a wire:navigate href=" {{route('cart')}}" class="text-orange-color">
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
                class="divide-y-4 space-y-2 shadow-xl dropdown-content z-20 fixed top-0 left-0 rtl:right-0 bg-white text-black w-[300px] h-screen transform -translate-x-4 rtl:translate-x-4 transition-transform duration-300 ease-in-out menu-visible">

                <div class="my-3">
                    <div class="text-center text-2xl flex place-content-center">
                        <x-app-logo />
                    </div>
                </div>
                <div class="divide-y-2">
                    <div class="my-3">
                        <ul class="">
                            <li class="p-2 hover:bg-orange-200 font-bold">
                                <a wire:navigate class="text-sm w-full flex items-center justify-start" href="{{route('cart')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M6.15 6l2.4 5h7l2.75-5zM5.2 4h14.75q.575 0 .875.513t.025 1.037l-3.55 6.4q-.275.5-.737.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.7-.987t-.05-1.963L6.6 11.6L3 4H1V2h3.25zm3.35 7h7z" />
                                    </svg>
                                    <span class="ms-2 block text-base">Cart</span>
                                </a>
                            </li>
                            <li class="p-2 hover:bg-orange-200 font-bold">
                                <a wire:navigate class="text-sm w-full flex items-center justify-start" href="{{route('track-orders')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M3 13.5L2.25 12H7.5l-.6-1.5H2L1.25 9h7.8l-.6-1.5H1.11L.25 6H4a2 2 0 0 1 2-2h12v4h3l3 4v5h-2a3 3 0 0 1-3 3a3 3 0 0 1-3-3h-4a3 3 0 0 1-3 3a3 3 0 0 1-3-3H4v-3.5zm16 5a1.5 1.5 0 0 0 1.5-1.5a1.5 1.5 0 0 0-1.5-1.5a1.5 1.5 0 0 0-1.5 1.5a1.5 1.5 0 0 0 1.5 1.5m1.5-9H18V12h4.46zM9 18.5a1.5 1.5 0 0 0 1.5-1.5A1.5 1.5 0 0 0 9 15.5A1.5 1.5 0 0 0 7.5 17A1.5 1.5 0 0 0 9 18.5" />
                                    </svg>
                                    <span class="ms-2 block text-base">Your Orders</span>
                                </a>
                            </li>
                            <li class="p-2 hover:bg-orange-200 font-bold">
                                <a wire:navigate class="text-sm w-full flex items-center justify-start" href="{{route('search')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M21 5c-1.11-.35-2.33-.5-3.5-.5c-1.95 0-4.05.4-5.5 1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5c.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5c1.35-.85 3.8-1.5 5.5-1.5c1.65 0 3.35.3 4.75 1.05c.1.05.15.05.25.05c.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1m0 13.5c-1.1-.35-2.3-.5-3.5-.5c-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5c1.2 0 2.4.15 3.5.5z" />
                                        <path fill="currentColor" d="M17.5 10.5c.88 0 1.73.09 2.5.26V9.24c-.79-.15-1.64-.24-2.5-.24c-1.7 0-3.24.29-4.5.83v1.66c1.13-.64 2.7-.99 4.5-.99M13 12.49v1.66c1.13-.64 2.7-.99 4.5-.99c.88 0 1.73.09 2.5.26V11.9c-.79-.15-1.64-.24-2.5-.24c-1.7 0-3.24.3-4.5.83m4.5 1.84c-1.7 0-3.24.29-4.5.83v1.66c1.13-.64 2.7-.99 4.5-.99c.88 0 1.73.09 2.5.26v-1.52c-.79-.16-1.64-.24-2.5-.24" />
                                    </svg>
                                    <span class="ms-2 block text-base">Books</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="my-3">
                        <ul class="">
                            @role('admin')
                            <li class="p-2 hover:bg-orange-200 font-bold">
                                <a class="text-sm w-full flex items-center justify-start" href="" wire:click.prevent="redirectToAdminDashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h6v18zm8 0v-9h8v7q0 .825-.587 1.413T19 21zm0-11V3h6q.825 0 1.413.588T21 5v5z" />
                                    </svg>
                                    <span class="ms-2 block text-base">Dashboard</span>
                                </a>
                            </li>
                            @endrole
                            @auth
                            <li class="p-2 hover:bg-orange-200 font-bold">
                                <a wire:navigate class="text-sm w-full flex items-center justify-start" href="{{route('profile')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                    </svg>
                                    <span class="ms-2 block text-base">Profile</span>
                                </a>
                            </li>
                            <li class="p-2hover:bg-orange-200 font-bold w-full">
                                <a wire:click.prevent="logout" wire:confirm="Are you sure you want to logout?" class=" w-full text-red-600 p-2 text-center text-sm font-bold flex justify-center items-center hover:bg-orange-200" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z" />
                                    </svg>
                                    <span class="ms-2 block text-base">Logout</span>
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
