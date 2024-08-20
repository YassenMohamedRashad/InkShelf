@props([
'disabled' => false,
'showpass' => false,
])



<div x-data="{ show: @json(!$showpass) }" class="flex items-center rounded-md border border-gray-300 shadow-sm">
    @if (isset($icon))
    <div>
        <span class="flex items-center px-2 text-gray-400">
            {{ $icon }}
        </span>
    </div>
    @endif


    <div class="w-full relative">
        <input
            :type="show ? 'text' : 'password'"
            {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge([
        'class' => 'py-3 text-black w-full border-0 focus:ring focus:ring-orange-color focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded h-full py-2 pl-2 pr-12 leading-none' // Adjusted padding to avoid overlap with button
        ]) !!}
        />
        @if ($showpass)
        <button type="button" @click="show = !show"
            class="absolute right-0 top-0 h-full px-4 bg-orange-color text-white text-sm rounded-r-md flex items-center justify-center">
            <span x-show="!show">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m19.1 21.9l-3.5-3.45q-.875.275-1.775.413T12 19q-3.35 0-6.125-1.8t-4.35-4.75q-.125-.225-.187-.462t-.063-.488t.063-.488t.187-.462q.55-.975 1.175-1.9T4.15 7L2.075 4.9Q1.8 4.625 1.8 4.213t.3-.713q.275-.275.7-.275t.7.275l17 17q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275M12 16q.275 0 .525-.025t.5-.1l-5.4-5.4q-.075.25-.1.5T7.5 11.5q0 1.875 1.313 3.188T12 16m0-12q3.35 0 6.138 1.813t4.362 4.762q.125.2.188.438t.062.487t-.05.488t-.175.437q-.475.925-1.062 1.75t-1.313 1.55q-.35.35-.825.325t-.825-.375l-2-2q-.175-.175-.225-.413t.025-.487q.1-.325.15-.625t.05-.65q0-1.875-1.312-3.187T12 7q-.35 0-.65.05t-.625.15q-.25.075-.5.025T9.8 7l-.825-.825q-.475-.475-.312-1.1t.787-.8q.625-.125 1.263-.2T12 4m1.975 5.65q.275.325.462.713t.238.812q.025.2-.15.275t-.325-.075l-2.05-2.05Q12 9.175 12.088 9t.287-.175q.475.05.875.263t.725.562" />
                </svg>
            </span>
            <span x-show="show">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 16q1.875 0 3.188-1.312T16.5 11.5t-1.312-3.187T12 7T8.813 8.313T7.5 11.5t1.313 3.188T12 16m0-1.8q-1.125 0-1.912-.788T9.3 11.5t.788-1.912T12 8.8t1.913.788t.787 1.912t-.787 1.913T12 14.2m0 4.8q-3.35 0-6.113-1.8t-4.362-4.75q-.125-.225-.187-.462t-.063-.488t.063-.488t.187-.462q1.6-2.95 4.363-4.75T12 4t6.113 1.8t4.362 4.75q.125.225.188.463t.062.487t-.062.488t-.188.462q-1.6 2.95-4.362 4.75T12 19" />
                </svg>

            </span>
        </button>
        @endif
    </div>



</div>





<x-slot name="icon"></x-slot>
