<section class="lg:h-[80vh] bg-orange-color lg:bg-hero-image lg:overflow-hidden bg-image p-10 lg:p-20 lg:flex lg:justify-between">
    <div class="text-center lg:text-left lg:rtl:text-right h-full w-full p-3 lg:max-w-[450px] place-content-center">
        <div>
            <h1 class="max-w-2xl mb-4 text-4xl text-white lg:text-black font-extrabold leading-none md:text-5xl xl:text-6xl rtl:text-white">{{__('READ AND ADD YOUR INSIGHT')}}</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:text-gray-500 lg:rtl:text-gray-300 lg:mb-8 md:text-lg lg:text-xl">{{__('Hero desc')}}</p>
            <x-splade-button type="link" href="/books">
                {{__("Let's start")}}
            </x-splade-button>
        </div>

    </div>

    <div class="hidden lg:block">
        <img src="{{asset('images/home/Layer 1.png')}}" class="shadow-2xl w-[400px] aspect-auto" alt="mockup">
    </div>
</section>
