<div class="w-[90%] p-4 md:p-6 flex flex-col gap-6 mx-auto">

    <div class="flex flex-col xl:flex-row gap-6 ">

        {{-- Profil --}}
        <div class="bg-white dark:bg-dark glass p-6 flex flex-col xl:flex-row xl:items-stretch gap-6 flex-1">

            <div class="shrink-0 mx-auto xl:mx-0">
                <img src="{{ $umkm->image ? asset('storage/umkm/profile/' . $umkm->image) : asset('images/profile.png') }}"
                    alt="Foto UMKM"
                    class="rounded-full w-32 h-32 md:w-44 md:h-44 object-cover border-4 border-primary shadow" />
            </div>

            <div class="flex-1 flex flex-col gap-2 items-center xl:items-start mx-auto xl:mx-0 text-center xl:text-left">
                <h1 class="text-2xl font-bold text-text dark:text-white">{{ $umkm->umkm_name }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-300">Pemilik: {{ $umkm->user->name ?? '-' }}</p>
                @if ($umkm->location)
                    <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                        {{ $umkm->location }}
                    </p>
                @endif

                <div class="flex flex-wrap gap-2 mt-2 justify-center xl:justify-start">
                    @forelse ($categories as $category)
                        <span
                            class="bg-primary/10 text-primary px-3 py-1 rounded-bl-xl rounded-tr-xl text-xs font-medium border border-primary/30">
                            {{ $category->category_name }}
                        </span>
                    @empty
                        <span class="text-sm italic text-gray-400">Belum ada kategori</span>
                    @endforelse
                </div>

                <div class="mt-5">
                    @if (!$collabStatus || $collabStatus === 'none' || $collabStatus === 'cancelled' || $collabStatus === 'rejected')
                        <button wire:click="openCollabModal" class="btn-primary">
                            Ajukan Kolaborasi
                        </button>
                    @elseif ($collabStatus === 'pending')
                        <button class="btn-primary opacity-60 cursor-not-allowed" disabled>
                            Menunggu Persetujuan
                        </button>
                    @elseif ($collabStatus === 'accepted')
                        <a href="{{ route('collaboration.detail', $currentCollab->id) }}" class="btn-primary">
                            Lihat Detail Kolaborasi
                        </a>
                    @elseif ($collabStatus === 'completed')
                        <button class="btn-primary opacity-70 cursor-default" disabled>
                            Kolaborasi Selesai
                        </button>
                    @endif
                </div>
                



            </div>

            <div
                class="flex flex-col justify-center items-center text-center gap-2 self-center p-6 xl:pl-4 w-full xl:w-auto">
                <div class="text-primary text-4xl font-bold">{{ $jumlahKolaborasi ?? 0 }}</div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Kolaborasi Aktif</p>
                <a href="" class="btn-primary mt-2">Lihat Detail</a>
            </div>
        </div>

    </div>

    {{-- Tentang Kami & Sertifikat --}}


    <div class="flex flex-col lg:flex-row gap-10 bg-white dark:bg-dark glass p-10">
        <div class="flex-1 space-y-8">
            {{-- Deskripsi --}}
            @if ($umkm->description)
                <div>
                    <h2 class="text-xl font-bold text-text dark:text-white mb-2">Tentang Kami</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $umkm->description }}
                    </p>
                </div>
            @endif

            {{-- Kontak  --}}
            @if ($umkm->website_url || $umkm->instagram_url || $umkm->facebook_url || $umkm->phone)
                <div>
                    <h3 class="text-sm font-semibold text-text dark:text-white mb-1">Kontak & Media Sosial</h3>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-700 dark:text-gray-300">
                        @if ($umkm->website_url)
                            <a href="{{ $umkm->website_url }}" target="_blank"
                                class="flex items-center gap-2 hover:text-primary">
                                <i class="fas fa-globe"></i> Website
                            </a>
                        @endif
                        @if ($umkm->instagram_url)
                            <a href="https://instagram.com/{{ $umkm->instagram_url }}" target="_blank"
                                class="flex items-center gap-2 hover:text-pink-500">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        @endif
                        @if ($umkm->facebook_url)
                            <a href="{{ $umkm->facebook_url }}" target="_blank"
                                class="flex items-center gap-2 hover:text-blue-600">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        @endif
                        @if ($umkm->phone)
                            <a href="https://wa.me/{{ $umkm->phone }}" target="_blank"
                                class="flex items-center gap-2 hover:text-green-500">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Sertifikat --}}
            @if (!empty($umkm->certificates) && is_array($umkm->certificates) && count($umkm->certificates))
                <div class="space-y-3">
                    <h2 class="text-xl font-bold text-text dark:text-white flex items-center gap-2">

                        Sertifikat
                    </h2>

                    <div
                        class="flex gap-3 overflow-x-auto scrollbar-thin scrollbar-thumb-primary scrollbar-track-transparent pb-1">
                        @foreach ($umkm->certificates as $certificate)
                            <img src="{{ asset('storage/umkm/certificates/' . $certificate) }}" alt="Sertifikat"
                                class="h-32 object-contain rounded-lg border bg-white dark:bg-dark shadow cursor-pointer hover:scale-105 hover:opacity-80"
                                wire:click="showCertificatePreview('{{ $certificate }}')" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- priview sertifikat --}}
        @if ($showPreviewCertificates)
            <div class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center px-4">
                <div class="relative bg-white dark:bg-dark p-4 rounded-xl shadow-xl max-w-3xl w-full">
                    <button wire:click="closePreview"
                        class="absolute top-2 right-2 w-8 h-8 bg-primary rounded-full text-white hover:text-red-500 text-2xl font-bold">
                        &times;
                    </button>

                    <img src="{{ asset('storage/umkm/certificates/' . $previewFilenameCertificates) }}"
                        alt="Preview Sertifikat" class="w-full h-[70vh] object-contain rounded" loading="lazy"
                        decoding="async" />
                </div>
            </div>
        @endif

    </div>

    {{-- Galeri Foto --}}
    @if (!empty($umkm->gallery) && is_array($umkm->gallery) && count($umkm->gallery))

        <div class="flex flex-col bg-white dark:bg-dark glass p-10">
            <h2 class="text-xl font-bold text-text dark:text-white mb-2">Galeri Foto {{ $umkm->umkm_name }}</h2>


            <div class="mt-10 columns-2 sm:columns-3 md:columns-4 gap-4 space-y-4">
                @foreach ($umkm->gallery as $gambar)
                    <div wire:click="showGalleryPreview('{{ $gambar }}')"
                        class="break-inside-avoid overflow-hidden rounded-lg shadow-md bg-white dark:bg-dark cursor-pointer hover:scale-[1.02] transition">
                        <div class="relative bg-gray-100 dark:bg-gray-800 overflow-hidden rounded-lg shadow-md">
                            <div
                                class="absolute inset-0 animate-pulse bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 z-0">
                            </div>
                            <img src="{{ asset('storage/umkm/gallery/' . $gambar) }}"
                                onload="this.previousElementSibling.style.display='none';" alt="Galeri UMKM"
                                class="w-full h-auto object-contain relative z-10 transition duration-300" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- Priview galeri --}}
    @if ($showPreviewGallery)
        <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center px-4">
            <div
                class="bg-white dark:bg-dark p-6 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto space-y-6 border border-primary/20 glass relative">

                <button wire:click="closePreview"
                    class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">×</button>

                <div class="flex justify-center">
                    <div
                        class="overflow-hidden rounded-xl border border-gray-300 dark:border-gray-600 max-w-3xl w-full aspect-video flex items-center justify-center">
                        <img src="{{ asset('storage/umkm/gallery/' . $previewFilenameGallery) }}"
                            class="w-full h-full object-contain transition duration-300 ease-in-out rounded-xl"
                            alt="Preview Gambar">
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($showCollabModal)
    <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center px-4">
        <div class="bg-white dark:bg-dark p-6 rounded-2xl shadow-xl w-full max-w-2xl space-y-4 glass border border-primary/20 relative">

            <button wire:click="closeCollabModal"
                class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">×</button>

            <!-- Komponen form-nya -->
            <livewire:collaboration.create :targetUmkm="$umkm->id" />
        </div>
    </div>
@endif

</div>
