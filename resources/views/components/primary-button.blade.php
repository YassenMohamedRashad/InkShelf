<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex gap-2 items-center justify-center bg-orange-color rounded-md font-semibold text-white tracking-widest hover:bg-dark-orange focus:bg-dark-orange focus:outline-none focus:ring-0 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
