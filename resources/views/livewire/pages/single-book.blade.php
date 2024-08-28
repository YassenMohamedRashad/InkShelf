<div class="bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4 items-center justify-center align-middle">
                <div class="rounded-lg mb-4 flex place-content-center">
                    <img class="aspect-auto w-[300px]" src="{{asset($book->cover)??asset('images/other/demo-book-poster.jpg')}}" alt="Book Image">
                </div>
                <div class="flex -mx-2 mb-4">
                    <div class="w-1/2 px-2">
                        <form wire:submit="addToCart( {{ $book->id }})" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-outline p-0 w-full text-orange-color hover:bg-orange-color hover:border-orange-color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 9q-.425 0-.713-.288T11 8V6H9q-.425 0-.713-.288T8 5q0-.425.288-.713T9 4h2V2q0-.425.288-.713T12 1q.425 0 .713.288T13 2v2h2q.425 0 .713.288T16 5q0 .425-.288.713T15 6h-2v2q0 .425-.288.713T12 9ZM7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM7 17q-1.15 0-1.738-.988T5.25 14.05L6.6 11.6L3 4H2q-.425 0-.713-.288T1 3q0-.425.288-.713T2 2h1.65q.275 0 .525.15t.375.425L8.525 11h7.025l3.6-6.5q.125-.225.35-.363T20 4q.575 0 .863.488t.012.987L17.3 11.95q-.275.5-.738.775T15.55 13H8.1L7 15h11q.425 0 .713.288T19 16q0 .425-.288.713T18 17H7Z" />
                                </svg>
                                Add to cart
                            </button>
                        </form>
                    </div>
                    <div class="w-1/2 px-2">
                        <form wire:submit="addToCart( {{ $book->id }})" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-outline p-0 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5C22 5.42 19.58 3 16.5 3m-4.4 15.55l-.1.1l-.1-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05" />
                                </svg>
                                Add to favorites
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">{{$book->title}} <span class="text-small text-gray-400 text-sm ms-1">{{$book->publishedDate??""}}</span></h2>

                    @if ($categories)
                    <div class="flex divide-x-2">
                        @foreach ($categories as $category)
                        <span class="px-2">{{$category->name}}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="flex mb-4">
                    <div class="mr-4">
                        <span class="font-bold text-gray-700 ">Price:</span>
                        <span class="text-gray-600 ">${{$book->price}}</span>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 ">Left in stock:</span>
                        <span class="{{$book->stock<10?'text-red-500':'text-gray-600'}}">{{$book->stock}}</span>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-gray-500  text-sm mt-2">
                        {{$book->description}}
                    </p>
                </div>
                @if (count($book->authors()->get()) > 0)
                <div class="mb-4">
                    <span class="font-bold text-gray-700 ">Written By:</span>
                    <div class="flex items-center mt-2">
                        <div class="flex divide-x-2">
                            @foreach ($book->authors()->get() as $author)
                            <span class="px-2">{{$author->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if ($book->pdf || $book->webReaderLink)
                <div class="mb-4 flex gap-2">
                    @if ($book->pdf)
                    <div>
                        <a href="{{$book->pdf}}" class="btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M6 2c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm7 7V3.5L18.5 9z" />
                            </svg>
                            pdf version
                        </a>
                    </div>
                    @endif
                    @if ($book->webReaderLink)
                    <div>
                        <a href="{{$book->webReaderLink}}" class="btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21 5c-1.11-.35-2.33-.5-3.5-.5c-1.95 0-4.05.4-5.5 1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5c.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5c1.35-.85 3.8-1.5 5.5-1.5c1.65 0 3.35.3 4.75 1.05c.1.05.15.05.25.05c.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1m0 13.5c-1.1-.35-2.3-.5-3.5-.5c-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5c1.2 0 2.4.15 3.5.5z" />
                                <path fill="currentColor" d="M17.5 10.5c.88 0 1.73.09 2.5.26V9.24c-.79-.15-1.64-.24-2.5-.24c-1.7 0-3.24.29-4.5.83v1.66c1.13-.64 2.7-.99 4.5-.99M13 12.49v1.66c1.13-.64 2.7-.99 4.5-.99c.88 0 1.73.09 2.5.26V11.9c-.79-.15-1.64-.24-2.5-.24c-1.7 0-3.24.3-4.5.83m4.5 1.84c-1.7 0-3.24.29-4.5.83v1.66c1.13-.64 2.7-.99 4.5-.99c.88 0 1.73.09 2.5.26v-1.52c-.79-.16-1.64-.24-2.5-.24" />
                            </svg>
                            view online
                        </a>
                    </div>
                    @endif

                </div>
                @endif

                <div class="mb-4">
                    <span>Number of rates : {{$book->no_rates}}</span>
                </div>


            </div>
        </div>
    </div>
</div>
