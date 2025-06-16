<div class="w-[90%] mx-auto flex flex-col gap-6 glass transition my-shadow bg-white dark:bg-dark p-10">


    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Profil UMKM</h2>
    <div class="flex flex-col xl:flex-row xl:items-start gap-8">
        <div class="relative flex justify-center items-center xl:w-1/5">
            <img src="{{ $image ? $image->temporaryUrl() : ($umkm->image ? asset('storage/umkm/profile/' . $umkm->image) : asset('images/profile.png')) }}"
                alt="Foto UMKM"
                class="rounded-full w-40 h-40 md:w-44 md:h-44 object-cover border-4 border-primary shadow">

            <label
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 bg-primary text-white text-xs font-semibold px-4 py-2 rounded-full shadow cursor-pointer hover:bg-primary/90 transition">
                Ganti
                <input type="file" wire:model="image" class="hidden" />
            </label>

            @error('image')
                <p class="absolute -bottom-6 text-red-500 text-xs w-full text-center">{{ $message }}</p>
            @enderror
        </div>

        {{-- Form Info Utama --}}
        <div class="flex-1 flex flex-col gap-4">

            {{-- Nama UMKM --}}
            <div class="flex flex-col gap-1">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nama UMKM</label>
                <input type="text" wire:model="umkm_name" class="input-field">
                @error('umkm_name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Username --}}
            <div class="flex flex-col gap-1">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Username</label>
                <input type="text" wire:model="username" class="input-field">
                @error('username')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="flex flex-col gap-1">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Lokasi</label>
                <input type="text" wire:model="location" class="input-field">
                @error('location')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    {{-- Kategori Terpilih --}}
    <div class="flex-1 flex flex-col gap-3">

        <h2 class="text-sm font-semibold">Kategori Terpilih:</h2>

        @if (count($selectedCategories) > 0)
            <div class="flex flex-wrap gap-2">
                @foreach ($categories->whereIn('id', $selectedCategories) as $selected)
                    <span
                        class="bg-primary/20 text-primary shadow bg-opacity-40 px-4 py-1 rounded-bl-xl rounded-tr-xl text-sm">
                        {{ $selected->category_name }}
                    </span>
                @endforeach
            </div>
        @else
            <p class="text-white/70 italic">Belum ada kategori yang dipilih.</p>
        @endif
        @error('selectedCategories')
            <span class="text-red-500 mt-2">{{ $message }}</span>
        @enderror

        <button wire:click="toggleCategoryModal"
            class="text-sm btn-primary mt-2 self-start flex items-center gap-2 transition">
            Ubah Kategori
            <i class="fas {{ $showCategoryModal ? 'fa-chevron-up' : 'fa-chevron-down' }}"></i>
        </button>

        <!-- Modal Kategori -->
        @if ($showCategoryModal)
            <div class="glass w-[90%] max-w-2xl animate-fade-in-scale">
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Pilih maksimal 3 kategori</p>

                <div class="flex flex-wrap gap-3 mt-10">
                    @foreach ($categories as $category)
                        @php
                            $isSelected = in_array($category->id, $selectedCategories);
                            $disableClick = !$isSelected && count($selectedCategories) >= 3;
                        @endphp

                        <div wire:click="{{ $disableClick ? '' : "toggleCategory({$category->id})" }}"
                            class="text-sm cursor-pointer px-4 py-2 rounded-xl border border-white/20 text-center select-none transition duration-200
                    {{ $isSelected
                        ? 'bg-primary/10 text-primary ring-2 ring-primary shadow'
                        : ($disableClick
                            ? 'opacity-50 cursor-not-allowed'
                            : 'hover:bg-primary/10 hover:text-primary') }}"
                            @if ($disableClick) title="Maksimal pilih 3 kategori" @endif>
                            {{ $category->category_name }}
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    <button wire:click="toggleCategoryModal"
                        class="px-7 py-2 bg-primary text-white rounded-xl hover:bg-primary/90 transition">Selesai</button>
                </div>
            </div>
        @endif

    </div>



    {{-- Description --}}
    <div class="flex flex-col gap-1 mt-5">
        <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Tentang Kami</label>
        <textarea rows="6" wire:model="description" class="input-field w-full"></textarea>
        @error('description')
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>

    {{-- KONTAK --}}
    <div class="flex flex-col md:flex-row gap-6">

        {{-- Website --}}
        <div class="flex-1 flex flex-col gap-1">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Website</label>
            <input type="text" wire:model="website_url" class="input-field">
            @error('website_url')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Instagram --}}
        <div class="flex-1 flex flex-col gap-1">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Instagram</label>
            <input type="text" wire:model="instagram_url" class="input-field">
            @error('instagram_url')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="flex flex-col md:flex-row gap-6 mt-4">

        {{-- Facebook --}}
        <div class="flex-1 flex flex-col gap-1">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Facebook</label>
            <input type="text" wire:model="facebook_url" class="input-field">
            @error('facebook_url')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="flex-1 flex flex-col gap-1">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nomor Telepon</label>
            <input type="text" wire:model="phone" class="input-field">
            @error('phone')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

    </div>


    <div class="flex items-center gap-4 pt-4">
        <button wire:click="save"
            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-xl font-semibold shadow transition flex items-center gap-2">
            Simpan Perubahan
        </button>
    
        <div wire:loading wire:target="save">
            <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </div>
    </div>
    

</div>

