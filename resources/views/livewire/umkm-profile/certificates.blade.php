<div class="glass p-4 sm:p-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h2 class="text-xl font-bold text-text dark:text-white flex items-center gap-2">
            <i class="fa-solid fa-certificate text-primary text-lg"></i>
            Sertifikat
        </h2>

        <div class="flex items-center gap-3">
            <label for="sertifikatFile"
                class="flex justify-center items-center w-9 h-9 bg-primary text-white rounded-full cursor-pointer hover:bg-primary/90 transition shadow">
                <i class="fa-solid fa-plus text-sm"></i>
                <input type="file" wire:model="certificate" id="sertifikatFile" accept="image/*" class="hidden" />
            </label>

            {{-- Tombol Lihat Semua --}}
            @if (!empty($umkm->certificates))
                <button wire:click="$set('showCertificates', true)"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-dark border border-primary text-primary hover:bg-primary hover:text-white transition shadow">
                    <i class="fa-solid fa-eye"></i>
                    Lihat Semua
                </button>
            @endif
        </div>
    </div>

    @error('certificate')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    {{-- Preview Slider --}}
    @if (!empty($umkm->certificates) && is_array($umkm->certificates) && count($umkm->certificates))
        <div x-data="{
            activeIndex: 0,
            certificates: {{ json_encode($umkm->certificates) }},
            next() { if (this.activeIndex < this.certificates.length - 1) this.activeIndex++; },
            prev() { if (this.activeIndex > 0) this.activeIndex--; }
        }" class="mt-4 space-y-4">
            <div class="relative w-full h-64 rounded-xl shadow flex items-center justify-center overflow-hidden">
                <template x-if="certificates.length">
                    <img :src="'/storage/umkm/certificates/' + certificates[activeIndex]"
                        loading="lazy"
                        decoding="async"
                        class="max-w-full max-h-full object-contain rounded-lg transition-all duration-300 ease-in-out"
                        alt="Sertifikat" />
                </template>

                <button @click="prev" x-show="activeIndex > 0"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-primary/10 border border-primary/50 text-primary w-8 h-8 rounded-full flex items-center justify-center shadow hover:bg-white transition">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button @click="next" x-show="activeIndex < certificates.length - 1"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-primary/10 border border-primary/50 text-primary w-8 h-8 rounded-full flex items-center justify-center shadow hover:bg-white transition">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="flex gap-3 mt-4 overflow-x-auto justify-start scrollbar-thin scrollbar-thumb-primary scrollbar-track-transparent px-1">
                <template x-for="(cert, i) in certificates" :key="i">
                    <img :src="'/storage/umkm/certificates/' + cert"
                        loading="lazy"
                        decoding="async"
                        @click="activeIndex = i"
                        :class="{ 'ring-2 ring-primary': i === activeIndex }"
                        class="min-w-[4rem] h-16 object-cover rounded border cursor-pointer hover:ring-2 hover:ring-primary transition border-hidden"
                        alt="Thumbnail" />
                </template>
            </div>
        </div>
    @else
        <div class="mt-5 w-full flex flex-col items-center justify-center gap-4 bg-white/50 dark:bg-dark/30 border-2 border-dashed border-primary/40 rounded-lg py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9 4h18M4 6h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
            <p class="text-sm text-gray-600 dark:text-gray-300 text-center max-w-sm">
                Belum ada sertifikat yang ditambahkan. Sertifikat yang kamu miliki akan muncul di sini.
            </p>
        </div>
    @endif

    {{-- MODAL PREVIEW --}}
    @if ($ShowModalCertificates)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur">
            <div class="bg-white dark:bg-dark p-6 rounded-xl shadow-xl w-full max-w-md text-center">
                <div class="w-full h-64 mb-4 bg-gray-100 dark:bg-gray-800 rounded flex items-center justify-center overflow-hidden">
                    @if ($previewUrl)
                        <img src="{{ $previewUrl }}" class="max-w-full max-h-full object-contain" loading="lazy" decoding="async" />
                    @endif
                </div>
                <div class="flex justify-center gap-4">
                    <button wire:click="uploadSertificate" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded font-semibold">Tambah</button>
                    <button wire:click="cancel" class="text-red-500 hover:underline px-4 py-2 font-medium">Batal</button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL SERTIFIKAT --}}
    @if ($showCertificates)
        <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur flex items-center justify-center px-4">
            <div class="bg-white dark:bg-dark p-6 sm:p-10 glass shadow-lg rounded-xl w-full max-w-5xl overflow-y-auto relative">
                <button wire:click="$set('showCertificates', false)" class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
                <h3 class="text-xl font-bold mb-6 text-center">Semua Sertifikat</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($umkm->certificates as $certificate)
                        <div class="relative group">
                            <img src="{{ asset('storage/umkm/certificates/' . $certificate) }}" alt="Sertifikat" class="w-full h-40 sm:h-48 object-contain glass" loading="lazy" decoding="async" />
                            <label class="absolute top-2 left-2 w-8 h-8 cursor-pointer group">
                                <input type="checkbox" wire:model="selectedCertificates" value="{{ $certificate }}" class="peer absolute opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="w-full h-full flex items-center justify-center rounded-full bg-white border border-gray-300 text-white transition-all duration-150 peer-checked:bg-primary peer-checked:border-primary">
                                    <i class="fa-solid fa-check text-sm hidden peer-checked:block"></i>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-center gap-4">
                    <button wire:click="deleteSelected" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold flex items-center gap-2">
                        <i class="fas fa-trash-alt"></i> Hapus yang Dipilih
                    </button>
                    <button wire:click="$set('showCertificates', false)" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded font-medium">Tutup</button>
                </div>
            </div>
        </div>
    @endif
</div>
