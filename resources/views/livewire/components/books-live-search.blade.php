<div class="{{$class}} relative">
    <input
        wire:model.live.debounce.500ms="search_term"
        type="text"
        name="query"
        class="border-orange-color focus:ring-0 join-item w-full focus:border-dark-orange"
        placeholder="{{__('search for books , categories , ISBN .....')}}" />

    <ul class="absolute bg-white divide-y-2 p-2 w-full rounded-md {{count($books)==0 ? 'hidden' : ''}}">
        @foreach ($books as $book)
        <li wire:key="{{$book['id']??'1'}}">
            <a wire:click.prevent="filterBook({{json_encode($book)}})" wire:navigate class="flex p-2 space-x-2 hover:bg-gray-200 rounded-lg items-center">
                <div><img src="{{$book['cover']}}" class="aspect-auto w-[40px]"></div>
                <div class="font-bold">{{$book['title']}}</div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
