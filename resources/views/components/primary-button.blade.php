<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-orange-color border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark-orange focus:bg-dark-orange  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
