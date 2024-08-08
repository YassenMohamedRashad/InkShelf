<x-layout>
    <section class="h-[90vh] bg-image overflow-hidden" style="background-image: url({{asset('images/home/hero.jpg')}});">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 h-full">
            <div class="m-auto lg:mr-auto text-center lg:text-left place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">READ AND ADD <br> YOUR INSIGHT</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">From checkout to global sales tax compliance, companies around the world use Flowbite to simplify their payment stack.</p>
                <a href="#" class="px-5 py-3 font-medium text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 ">
                    Speak to Sales
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{asset('images/home/3484256-removebg-preview 1.png')}}" class="max-w-full" alt="mockup">
            </div>
        </div>
    </section>
</x-layout>