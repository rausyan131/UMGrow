<div class="flex flex-col lg:flex-row gap-10 bg-white dark:bg-dark glass p-10">

    {{-- Description --}}
    <div class="flex-1">
        <h2 class="text-xl font-bold text-text dark:text-white mb-2">Tentang Kami</h2>
        <p class="mt-5 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
            {{ $umkm->description ?? 'Deskripsi belum tersedia.' }}
        </p>

        <div class="mt-4 space-y-2">
            <h3 class="text-sm font-semibold text-text dark:text-white">Kontak & Media Sosial</h3>
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
    </div>

    {{-- Sertifikat --}}
    <div class="flex-1">
        <livewire:umkm-profile.certificates />
    </div>

</div>
