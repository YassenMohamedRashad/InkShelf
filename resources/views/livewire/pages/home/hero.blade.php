<div>
    <style>
        @media (min-width: 1024px) {
            #Homehero {
                background-image: url('images/home/hero.jpg');
            }
        }
    </style>
    <section class="lg:h-[80vh] bg-orange-color lg:overflow-hidden bg-image p-10 lg:p-20 lg:flex lg:justify-between" id="Homehero">
        <div class="text-center lg:text-left lg:rtl:text-right h-full w-full p-3 lg:max-w-[450px] place-content-center">
            <div>
                <h1 class="max-w-2xl mb-4 text-4xl text-white lg:text-black font-extrabold leading-none md:text-5xl xl:text-6xl rtl:text-white">{{__('READ AND ADD YOUR INSIGHT')}}</h1>
                <x-primary-button class="p-3 focus:outline-none focus:ring-0 focus:border-0">
                    {{__("Let's start")}}
                </x-primary-button>
            </div>
        </div>
        <div class="hidden lg:block">
            <img src="{{asset('images/other/demo-book-poster.jpg')}}" class=" shadow-2xl w-[400px] aspect-auto" alt="mockup">
        </div>
    </section>
</div>
