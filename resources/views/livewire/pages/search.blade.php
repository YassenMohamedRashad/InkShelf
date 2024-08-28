<div>
    <div class="p-5 w-full lg:w-3/4 m-auto place-content-center mb-32">
        <div>
            <div class="flex flex-col items-center justify-center my-5">
                <x-app-logo class="text-5xl lg:text-7xl" image="hidden" />
            </div>
            <div class="w-full">
                <x-text-input placeholder="search for books, categories, ISBN" wire:model.live.debounce.500ms="search_term">
                    <x-slot:icon>
                        <div class="text-orange-color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14" />
                            </svg>
                        </div>
                    </x-slot:icon>
                </x-text-input>
            </div>
        </div>
    </div>
    <div class="lg:w-[90%] place-content-center m-auto my-10">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-7 mb-10">
            @foreach ($books as $book)
            <livewire:components.book-card :book="$book" :key="$book->id" />
            @endforeach
        </div>

        <div class="text-center" x-intersect="$wire.loadMore()">
            <span class="loading loading-ring loading-lg text-orange-color"></span>
        </div>
    </div>
</div>
