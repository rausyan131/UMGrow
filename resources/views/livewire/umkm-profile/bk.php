


    {{-- Galeri --}}
    <div class="w-full bg-white dark:bg-dark glass p-6">
        <h2 class="text-xl font-bold text-text dark:text-white mb-4">Galeri</h2>

        @if (!empty($umkm->gallery) && is_array($umkm->gallery) && count($umkm->gallery))
            <div class="swiper mySwiper2 mb-4">
                <div class="swiper-wrapper">
                    @foreach ($umkm->gallery as $gallery)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/umkm/gallery/' . $gallery) }}"
                                alt="Galeri"
                                class="w-full h-64 object-contain rounded shadow-md" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next text-gray-700 dark:text-white"></div>
                <div class="swiper-button-prev text-gray-700 dark:text-white"></div>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($umkm->gallery as $gallery)
                        <div class="swiper-slide w-24 h-24">
                            <img src="{{ asset('storage/umkm/gallery/' . $gallery) }}" alt="Thumbnail"
                                class="w-full h-full object-cover rounded border" />
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center text-center text-gray-400 dark:text-gray-500 mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 17l-1.5-2a1.5 1.5 0 00-2.25 0L3 18h18l-4.5-6-4.5 6z" />
                </svg>
                <p class="text-sm italic">Belum ada foto galeri yang ditambahkan untuk UMKM ini.</p>
            </div>
        @endif
    </div>

    {{-- Produk --}}
    <div class="w-full bg-white dark:bg-dark glass p-6">
        <h2 class="text-xl font-bold text-text dark:text-white mb-4">Produk</h2>

        @if (!empty($umkm->products) && count($umkm->products))
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($umkm->products as $product)
                    <div class="bg-white dark:bg-dark rounded-lg shadow-md p-4 group transition-all">
                        <div class="relative overflow-hidden rounded">
                            <img src="{{ asset('storage/umkm/products/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-40 object-cover rounded mb-2 transition-transform duration-300 group-hover:scale-105">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <p class="text-xs text-white text-center px-2 leading-snug">
                                    {{ $product->description }}</p>
                            </div>
                        </div>
                        <h3 class="text-sm font-bold text-text dark:text-white">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-500">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center text-center text-gray-400 dark:text-gray-500 mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V7a2 2 0 00-2-2h-4.586a1 1 0 01-.707-.293l-1.414-1.414A2 2 0 009.586 3H6a2 2 0 00-2 2v8" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 17a4 4 0 004 4h10a4 4 0 004-4v-5H3v5z" />
                </svg>
                <p class="text-sm italic">Belum ada produk yang ditambahkan oleh UMKM ini.</p>
            </div>
        @endif
    </div>
</div>

<x-slot name="scripts">
    <script>
        const swiperGaleriThumbs = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });

        const swiperGaleriMain = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiperGaleriThumbs,
            },
        });
    </script>
</x-slot>
