<div>
    <style>
        @media (min-width: 1024px) {
            #Homehero {
                background-image: url('images/home/hero.jpg');
            }
        }

        @media (max-width: 1023px) {
            #Homehero {
                background-image: url('images/home/hero(small screen).jpg');
            }
        }
    </style>
    <section class="h-[80vh] bg-orange-color lg:overflow-hidden bg-image p-10 lg:p-20 lg:flex lg:justify-between" id="Homehero">
        <div class="text-center lg:text-left lg:rtl:text-right h-full w-full p-3 lg:max-w-[450px] place-content-center">
            <div class="flex flex-col align-middle items-center justify-center lg:block">
                <div class="lg:hidden my-3">
                    <img src="{{asset('images/other/demo-book-poster.jpg')}}" alt="" class="aspect-auto w-[200px] shadow">
                </div>
                <h1 class="max-w-2xl text-4xl text-white lg:text-black font-extrabold leading-none md:text-5xl xl:text-6xl rtl:text-white">{{__('READ AND ADD YOUR INSIGHT')}}</h1>
                <p class="text-gray-300 lg:text-gray-400 mb-4 text-lg">fing all books you need in one place</p>
                <x-primary-button class="p-3 focus:outline-none focus:ring-0 focus:border-0 m-auto lg:m-0">
                    {{__("Let's start")}}
                </x-primary-button>
            </div>
        </div>
        <div class="hidden lg:block">
            <img src="{{asset('images/other/demo-book-poster.jpg')}}" class=" shadow-2xl w-[400px] aspect-auto" alt="mockup">
        </div>
    </section>
</div>
