<div>
    <section class="py-5 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <div class="mb-5">
                <h2 class="font-manrope font-bold text-4xl leading-10 text-black text-center">
                    Your last orders
                </h2>
            </div>

            <div class="main-box rounded-xl pt-6 max-w-xl max-sm:mx-auto lg:max-w-full">
                @foreach ($orders as $order )
                <details class="collapse bg-base-200 border border-gray-200 rounded-md my-5  {{$order->status == "cancelled"?'opacity-50':""}}">
                    <summary class="collapse-title text-xl font-medium">
                        <div class="flex justify-between">
                            <div>
                                Order ID : <span class="font-bold ">#{{$order->id}}</span>
                                <div><span><span class="font-bold text-sm text-">${{$order->total_amount}}</span></span></div>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-end items-end sm:items-center sm:justify-center gap-2">
                                <div><span class="font-bold text-base">{{$order->created_at->format('d-M-Y')}}</span></div>
                                <div class="flex gap-1">
                                    <div><span class="font-bold text-sm text-dark-orange border-2 rounded-full bg-opacity-10 p-2 border-dark-orange bg-orange-color">{{$order->status}}</span></div>
                                    @if ($order->status == "pending")
                                    <div><button wire:click="cancel_order({{$order}})" class="text-red-500 btn btn-outline hover:bg-red-500 hover:border-red-700 bg-red-500 bg-opacity-10 border-2 rounded-full btn-sm">Cancel</button></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </summary>

                    <div class="collapse-content">
                        @foreach ($order->order_items as $item)
                        <a wire:navigate href="{{route('single-book',['id'=> $item->book->id])}}" class="flex justify-between my-5 hover:bg-orange-100 p-3">
                            <div class="flex gap-2">
                                <div>
                                    <img src="{{$item->book->cover}}" alt="" class="aspect-auto w-[50px]">
                                </div>
                                <div class="place-content-center">
                                    <div class="font-medium">{{substr($item->book->title,0,20)}}</div>
                                </div>
                            </div>
                            <div class="place-content-center">
                                <span class="font-bold">X{{$item->quantity}}</span>
                            </div>
                            <div class="place-content-center">
                                <span class="font-bold">${{$item->price}}</span>
                            </div>

                        </a>
                        @endforeach
                    </div>
                </details>
                @endforeach



            </div>
        </div>
    </section>

</div>
