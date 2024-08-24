<div class="w-[80%] m-auto p-5">
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
    <h1 class="text-2xl lg:text-4xl text-center font-bold my-5">Order Summary</h1>
    <hr>
    <div class="p-5 flex justify-between">
        <div>
            <h5 class="font-bold text-lg">
                {{auth()->user()->name}}
            </h5>
            <span class="text-gray-400 text-sm">
                {{auth()->user()->email}}
            </span>
        </div>

        <div>
            <p class="font-bold">
                Address : <span class="text-gray-600 font-normal">{{auth()->user()->address}}</span>
            </p>
            <p class="font-bold">
                Phone number : <span class="text-gray-600 font-normal">{{auth()->user()->phone_number}}</span>
            </p>
        </div>

    </div>

    <hr>
    <div class="max-h-[400px] overflow-y-scroll scrollbar-hidden">
        @foreach ($carts as $cart)
        <div class="grid grid-cols-3 items-center gap-4">
            <div class="col-span-2 flex items-center gap-4">
                <div class="w-24 h-24 shrink-0 bg-white p-2 rounded-md">
                    <img src='{{$cart->book->cover??asset('images/other/demo-book-poster.jpg')}}' class="w-full h-full object-contain" />
                </div>

                <div>
                    <h3 class="text-base font-bold text-gray-800">{{$cart->book->title}} <span class="text-gray-400">(x{{$cart->quantity}})</span></h3>
                </div>
            </div>
            <div class="ml-auto">
                <h4 class="text-base font-bold text-gray-800">${{$cart->book->price}}</h4>
            </div>
        </div>
        @endforeach
    </div>
    <hr>

    <div class="flex flex-col gap-2 my-5">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Subtotal:</h3>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">$ {{$total}}</h3>
            </div>

        </div>
        <div class="flex justify-between">
            <div>
                <h3 class="text-md font-bold text-gray-800">Shipping:</h3>
            </div>
            <div>
                <h3 class="text-md font-bold text-gray-800"><span class="ml-auto line-through ">$2.00</span> <span class="font-bold text-red-600 ms-2">0.00</span></h3>
            </div>

        </div>
        <div class="flex justify-between">
            <div>
                <h3 class="text-md font-bold text-gray-800">Taxes:</h3>
            </div>
            <div>
                <h3 class="text-md font-bold text-gray-800"><span class="ml-auto line-through ">$4.00</span> <span class="font-bold text-red-600 ms-2">0.00</span></h3>
            </div>

        </div>
    </div>

    <hr>

    <div class="flex justify-between my-5">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Total:</h3>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-800">$ {{$total}}</h3>
        </div>
    </div>

    <hr>

    <form wire:submit="place_order">
        <div class=" py-1">
            <x-input-label value="{{__('Choose payment method :')}}" class="mt-4 mb-2" />
            <div class="flex gap-3">
                <div>
                    <input v-model="payment_method" type="radio" checked class="radio border-orange-color checked:bg-orange-color checked:outline-none checked:ring-orange-color" />
                    <x-input-label :value="__('cash')" class="ms-1 inline" />
                </div>
                <div>
                    <input type="radio" disabled class="radio border-orange-color checked:bg-orange-color checked:outline-none checked:ring-orange-color" />
                    <label class="text-gray-400">
                        {{__('other')}}
                        <span class="text-xs">(coming soon)</span>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <x-input-label value="{{__('type any comment on order')}}" class="mt-4 mb-2" />
            <textarea wire:model="description" id="message" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-color focus:border-orange-color " placeholder="{{__('comment here')}}"></textarea>
            <x-primary-button class="p-2 my-3 w-full">
                place order
            </x-primary-button>
        </div>
    </form>


</div>
