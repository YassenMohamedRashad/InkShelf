<section class="p-5">
    <h2 class="text-left rtl:text-right text-xl lg:text-2xl py-3">{{$category->name}} :</h2>
    <div
        wire:ignore
        x-init="
    new Swiper($el,{
    modules: [ Navigation, Pagination ],
    slidesPerView: 1,
    spaceBetween: 15,
    pagination: {
        el: '.swiper-pagination',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
                // Tailwind's small screens
                0: {
                    slidesPerView: 2,  <!-- For very small screens -->
                },
                640: {
                    slidesPerView: 3,
                },
                // Tailwind's medium screens
                768: {
                    slidesPerView: 4,
                },
                // Tailwind's large screens
                1024: {
                    slidesPerView: 5,
                },
                // Tailwind's extra-large screens
                1280: {
                    slidesPerView: 6,
                },
                // Tailwind's 2xl screens
                1536: {
                    slidesPerView: 7,
                }
            }
    })
    "
        class="swiper">
        <!-- Additional required wrapper -->

        <div class="swiper-wrapper">
            @foreach ($category->books()->get() as $book)
            <livewire:components.book-card :book="$book" />
            @endforeach
        </div>
    </div>

</section>
