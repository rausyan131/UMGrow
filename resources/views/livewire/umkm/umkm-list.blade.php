<div class="space-y-10 w-[80%] mx-auto p-6">
    {{-- header --}}

    <div class="mb-10 rounded-bl-2xl rounded-tr-2xl overflow-hidden relative shadow-lg">
        <img src="{{ asset('images/umkm-header.jpg') }}" alt="UMKM Indonesia"
            class="w-full h-64 object-cover brightness-75">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold drop-shadow-lg">Jelajahi UMKM Lokal yang Menginspirasi </h1>
            <p class="mt-2 text-sm md:text-base max-w-xl drop-shadow-md">
                Temukan pelaku usaha kreatif dari berbagai kategori. Yuk, dukung UMKM Indonesia untuk tumbuh dan
                bersinar!
            </p>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

        <input type="text" wire:model="searchInput" placeholder="Cari UMKM atau Pemilik..."
            class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary/50 dark:bg-dark dark:text-white placeholder-gray-400" />

        {{-- Dropdown Kategori --}}
        <div class="w-full md:w-1/3">
            <select wire:model="category"
                class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary/50 dark:bg-dark dark:text-white">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-1 gap-2 items-center">

            <button wire:click="searchUmkm"
                class="flex items-center gap-2 px-4 py-2 bg-gray-400/30 text-white rounded-xl shadow hover:bg-primary/80 transition">
                <i class="fas fa-search"></i>
                <span class="hidden md:inline">Cari</span>
            </button>

            {{-- Loading Spinner --}}
            <div wire:loading wire:target="searchUmkm" class="flex items-center">
                <svg class="animate-spin h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </div>
        </div>


    </div>



    {{-- daftar UMKM --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @forelse ($umkms as $umkm)
            <a href="{{ route('umkm.detail', ['id' => $umkm->id]) }}"
                class="glass p-4 border border-transparent transition-shadow shadow-2xs hover:opacity-75 cursor-pointer duration-300 block">
                <div class="flex gap-4 items-center">
                    <img src="{{ $umkm->image ? asset('storage/umkm/profile/' . $umkm->image) : asset('images/profile.png') }}"
                        class="w-20 h-20 object-cover rounded-xl" />

                    <div class="flex-1 space-y-2">
                        <h3 class="text-lg font-semibold text-text dark:text-white/70">{{ $umkm->umkm_name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <i class="fas fa-user mr-1 text-gray-400"></i> {{ $umkm->user->name }}
                        </p>

                        <div class="flex flex-wrap mt-2 gap-1">
                            @foreach ($umkm->categories as $cat)
                                <span class="bg-primary/10 text-primary text-xs px-2 py-0.5 rounded-full">
                                    {{ $cat->category_name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div
                class="col-span-3 text-center text-gray-500 dark:text-gray-300 italic flex flex-col items-center gap-3 py-8">
                <i class="fas fa-search-minus text-4xl text-gray-400"></i>
                <p class="text-base font-medium">Tidak ada UMKM yang ditemukan</p>
                <p class="text-sm text-gray-400">Coba periksa kata kunci atau pilih kategori lain </p>
            </div>
        @endforelse
    </div>


    {{-- Pagination --}}
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between flex-wrap gap-4 text-sm">
            {{-- Prev --}}
            @if ($umkms->onFirstPage())
                <span class="px-4 py-2 text-gray-400 rounded-xl shadow-inner glass flex items-center gap-2">
                    <i class="fas fa-chevron-left"></i> Prev
                </span>
            @else
                <button wire:click="previousPage"
                    class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition flex items-center gap-2">
                    <i class="fas fa-chevron-left"></i> Prev
                </button>
            @endif

            {{-- Numbered --}}
            <div class="flex gap-2">
                @foreach ($umkms->getUrlRange(1, $umkms->lastPage()) as $page => $url)
                    @if ($page == $umkms->currentPage())
                        <span
                            class="px-4 py-2 rounded-xl bg-gray-300/30 dark:text-white text-text shadow glass">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                            class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            </div>

            {{-- Next --}}
            @if ($umkms->hasMorePages())
                <button wire:click="nextPage"
                    class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition flex items-center gap-2">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            @else
                <span class="px-4 py-2 text-gray-400 rounded-xl shadow-inner glass flex items-center gap-2">
                    Next <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>

    {{-- Detail UMKM --}}
    @if ($selectedUmkm)
        <div class="glass mt-8 p-6 rounded-2xl shadow-lg border border-primary/30">
            <div class="flex flex-col md:flex-row gap-6">
                <img src="{{ $selectedUmkm->image ? asset('storage/umkm/profile/' . $selectedUmkm->image) : asset('images/profile.png') }}"
                    class="w-32 h-32 rounded-xl object-cover border" />

                <div class="flex-1 space-y-2">
                    <h2 class="text-2xl font-bold text-orange-600">{{ $selectedUmkm->umkm_name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        <i class="fas fa-user text-primary mr-1"></i> Pemilik: {{ $selectedUmkm->user->name }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Lokasi: {{ $selectedUmkm->location }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-200">{{ $selectedUmkm->description }}</p>

                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($selectedUmkm->categories as $cat)
                            <span class="bg-primary/10 text-primary text-xs px-3 py-1 rounded-full">
                                {{ $cat->category_name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-3 flex flex-wrap gap-3 text-sm">
                        @if ($selectedUmkm->website_url)
                            <a href="{{ $selectedUmkm->website_url }}" target="_blank"
                                class="text-blue-600 hover:underline"><i class="fas fa-globe mr-1"></i>Website</a>
                        @endif
                        @if ($selectedUmkm->instagram_url)
                            <a href="{{ $selectedUmkm->instagram_url }}" target="_blank"
                                class="text-pink-500 hover:underline"><i class="fab fa-instagram mr-1"></i>Instagram</a>
                        @endif
                        @if ($selectedUmkm->facebook_url)
                            <a href="{{ $selectedUmkm->facebook_url }}" target="_blank"
                                class="text-blue-700 hover:underline"><i class="fab fa-facebook mr-1"></i>Facebook</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
