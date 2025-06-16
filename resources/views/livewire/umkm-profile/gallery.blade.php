<div class="w-full glass p-10 shadow-md space-y-6 bg:white dark:bg-dark">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-xl font-bold text-text dark:text-white">Galeri Foto</h2>

        <div class="flex flex-wrap items-center gap-3">
            {{-- Tombol Upload --}}
            <label for="galleryFile" class="flex items-center gap-2 btn-primary cursor-pointer" title="Unggah Gambar">
                <i class="fa-solid fa-upload"></i>
                Tambah Foto
                <input id="galleryFile" type="file" multiple class="hidden" wire:model="galleryUpload">
            </label>

            {{-- Tombol Tampilkan Semua --}}
            @if (!empty($umkm->gallery))
                <button wire:click="$set('showGallery', true)"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-dark border border-primary text-primary hover:bg-primary hover:text-white transition shadow-md">
                    <i class="fa-solid fa-trash-can"></i>
                    Hapus Foto
                </button>
            @endif
        </div>
    </div>

    @error('galleryUpload')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror

    {{-- Gallery --}}
    @if (!empty($umkm->gallery) && is_array($umkm->gallery) && count($umkm->gallery))
        <div class="mt-20 columns-2 sm:columns-3 md:columns-4 gap-4 space-y-4">
            @foreach ($umkm->gallery as $gambar)
                <div class="break-inside-avoid overflow-hidden rounded-lg shadow-md bg-white dark:bg-dark">
                    <div class="relative bg-gray-100 dark:bg-gray-800 overflow-hidden rounded-lg shadow-md">
                        <div
                            class="absolute inset-0 animate-pulse bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 z-0">
                        </div>
                        <img src="{{ asset('storage/umkm/gallery/' . $gambar) }}" alt="Galeri UMKM" loading="lazy"
                            onload="this.previousElementSibling.style.display='none';"
                            class="w-full h-auto object-contain relative z-10 transition duration-300 hover:scale-[1.03]" />
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div
            class="mt-5 w-full flex flex-col items-center justify-center gap-4 bg-white/50 dark:bg-dark/30 border-2 border-dashed border-primary/40 rounded-lg py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-3-3v6m-9 4h18M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
            <p class="text-sm text-gray-600 dark:text-gray-300 text-center max-w-sm">
                Belum ada foto galeri yang ditambahkan.
            </p>
        </div>
    @endif

    {{-- Preview Upload Modal --}}
    @if ($galleryUpload && count($galleryUpload) === 1)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur px-4">
            <div
                class="bg-white dark:bg-dark p-6 rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto space-y-6 border border-primary/20 glass">

                {{-- Header --}}
                <div class="text-center space-y-2">
                    <div class="flex justify-center text-primary text-3xl">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text dark:text-white">Pratinjau Foto</h3>
                </div>

                {{-- Gambar Preview (Satu Foto) --}}
                <div class="flex justify-center">
                    <div
                        class="relative overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 max-w-lg w-full aspect-video flex items-center justify-center">
                        <img src="{{ $galleryUpload[0]->temporaryUrl() }}"
                            class="w-full h-full object-contain transition duration-300 ease-in-out rounded-xl"
                            alt="Preview">
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-center gap-4 pt-2">
                    <button wire:click="uploadGallery"
                        class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-xl font-semibold shadow transition">
                        <i class="fas fa-upload mr-1"></i> Tambah
                    </button>
                    <button wire:click="$set('galleryUpload', [])"
                        class="text-red-500 hover:text-red-700 hover:underline px-6 py-2 font-medium transition">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    @endif


    {{-- Modal Tampilkan Semua --}}
    @if ($showGallery)
        <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur flex items-center justify-center px-4">
            <div
                class="bg-white dark:bg-dark p-6 sm:p-10 glass shadow-lg rounded-xl w-full max-w-5xl overflow-y-auto relative">
                <button wire:click="$set('showGallery', false)"
                    class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">×</button>

                <h3 class="text-xl font-bold mb-6 text-center">Semua Galeri</h3>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($umkm->gallery as $photo)
                        <div class="relative group">
                            <img src="{{ asset('storage/umkm/gallery/' . $photo) }}" alt="Galeri"
                                class="w-full h-40 sm:h-48 object-cover glass rounded" />

                            <label class="absolute top-2 left-2 w-8 h-8">
                                <input type="checkbox" wire:model="selectedGallery" value="{{ $photo }}"
                                    class="peer absolute opacity-0 w-full h-full z-10 cursor-pointer" />
                                <div
                                    class="w-full h-full flex items-center justify-center rounded-full bg-white border border-gray-300 transition-all peer-checked:bg-primary peer-checked:border-primary">
                                    <i class="fa-solid fa-check text-sm text-white hidden peer-checked:block"></i>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center gap-4">
                    <button wire:click="deleteGallerySelected"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold flex items-center gap-2">
                        <i class="fas fa-trash-alt"></i> Hapus yang Dipilih
                    </button>
                    <button wire:click="$set('showGallery', false)"
                        class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded font-medium">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
