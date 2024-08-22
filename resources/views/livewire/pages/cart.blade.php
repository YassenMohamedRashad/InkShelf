<div>
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge, and Firefox */
        .scrollbar-hidden {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
    <div class="font-sans container mx-auto bg-white py-4">
        <div class="grid md:grid-cols-3 gap-4">
            <div class="md:col-span-2 bg-gray-100 p-4 rounded-md">
                <h2 class="text-2xl font-bold text-gray-800">Cart</h2>
                <hr class="border-gray-300 mt-4 mb-8" />

                <div class="space-y-4 max-h-[400px] overflow-scroll scrollbar-hidden">


                    @if (count($carts) == 0)
                    <h2 class="text-3xl text-gray-300 text-center">Add some books to your cart</h2>
                    @endif
                    @foreach ($carts as $cart)
                    <div class="grid grid-cols-3 items-center gap-4">
                        <div class="col-span-2 flex items-center gap-4">
                            <div class="w-24 h-24 shrink-0 bg-white p-2 rounded-md">
                                <img src='{{$cart->book->cover??asset('images/other/demo-book-poster.jpg')}}' class="w-full h-full object-contain" />
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-gray-800">{{$cart->book->title}}</h3>
                                <button wire:click="remove_from_cart({{$cart->id}})" class="text-xs text-red-500 cursor-pointer mt-0.5">Remove</button>

                                <div class="flex gap-4 mt-4">
                                    <div>
                                        <div
                                            class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                            <button wire:click="decrease_quantity({{$cart->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                                    <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            <span class="mx-2.5">{{$cart->quantity}}</span>
                                            <button wire:click="increase_quantity({{$cart->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                                    <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                                                </svg>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <h4 class="text-base font-bold text-gray-800">${{$cart->book->price}}</h4>
                        </div>
                    </div>
                    @endforeach



                </div>
            </div>

            <div class="bg-gray-100 rounded-md p-4 md:sticky top-0 divide-y-2 py-8">
                <div class="my-2">
                    <h2 class="font-bold text-center text-2xl lg:text-4xl">Total</h2>
                </div>

                <ul class="text-gray-800 space-y-4 my-2 py-8">
                    <li class="flex flex-wrap gap-4 text-base ">Shipping <span class="ml-auto line-through ">$2.00</span> <span class="font-bold text-red-600">0.00</span></li>
                    <li class="flex flex-wrap gap-4 text-base">Tax <span class="ml-auto line-through">$4.00</span><span class="font-bold text-red-600">0.00</span></li>
                    <li class="flex flex-wrap gap-4 text-base font-bold">Total <span class="ml-auto">${{$total}}</span></li>
                </ul>

                <div class="space-y-2 my-2 py-8">
                    <x-primary-button class="p-2 w-full font-bold text-base" wire:click="checkout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                        </svg>
                        Checkout
                    </x-primary-button>
                    <button type="button" class="text-base px-4 py-2.5 w-full font-bold tracking-wide bg-transparent text-gray-800 border border-gray-300 rounded-md flex justify-center items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V8q0-.825.588-1.412T6 6h2q0-1.65 1.175-2.825T12 2t2.825 1.175T16 6h2q.825 0 1.413.588T20 8v12q0 .825-.587 1.413T18 22zm0-2h12V8h-2v2q0 .425-.288.713T15 11t-.712-.288T14 10V8h-4v2q0 .425-.288.713T9 11t-.712-.288T8 10V8H6zm4-14h4q0-.825-.587-1.412T12 4t-1.412.588T10 6M6 20V8z" />
                        </svg>
                        Continue Shopping
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
