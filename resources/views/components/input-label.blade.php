@props([
'value' => "",
'required' => null
])

<label {{ $attributes->merge(['class' => 'block text-base text-gray-700']) }}>
    {{ $value ?? $slot }} <span class="text-red-400 text-base">{{$required?"*":""}}</span>
</label>
