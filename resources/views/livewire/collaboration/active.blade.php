<div class="space-y-6 p-6 max-w-7xl mx-auto">

    {{-- Input Pencarian --}}
    <div class="flex justify-center">
        <input type="text"
            wire:model.debounce.500ms="search"
            placeholder="Cari berdasarkan nama UMKM partner..."
            class="w-full md:w-1/2 px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary focus:outline-none"
        >
    </div>

    {{-- Kolaborasi Aktif --}}
    @if ($collaborations->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($collaborations as $collab)
                @php
                    $isInitiator = $collab->initiator_umkm_id === Auth::user()->umkm->id;
                    $otherUmkm = $isInitiator ? $collab->partnerUmkm : $collab->initiatorUmkm;
                    $imagePath = $otherUmkm->image ? 'storage/umkm/' . $otherUmkm->image : 'images/profile.jpg';
                @endphp

                <a href="{{ route('collaboration.detail', ['id' => $collab->id]) }}"

                   class="block glass p-4 rounded-xl shadow-md border border-primary/20 hover:ring-2 hover:ring-primary/30 transition-all duration-200">

                    <div class="flex items-start gap-4">
                        {{-- Gambar UMKM --}}
                        <div class="w-16 h-16 flex-shrink-0 bg-white dark:bg-dark rounded-full overflow-hidden border border-gray-300">
                            <img src="{{ $otherUmkm->image ? asset('storage/umkm/profile/' . $otherUmkm->image) : asset('images/profile.png') }}"
                                 alt="{{ $otherUmkm->umkm_name }}"
                                 class="w-full h-full object-cover">
                        </div>

                        {{-- Info UMKM --}}
                        <div class="flex-1 space-y-1">
                            <h4 class="font-semibold text-text dark:text-white text-base md:text-lg">
                                {{ $otherUmkm->umkm_name }}
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Mulai: {{ \Carbon\Carbon::parse($collab->started_at)->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-[11px] italic text-gray-400">
                                Kamu sebagai {{ $isInitiator ? 'Inisiator' : 'Partner' }} 
                            </p>
                        </div>
                    </div>

                    {{-- Pesan Kolaborasi --}}
                    <div class="mt-3 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                        {{ $collab->message }}
                    </div>
                </a>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center text-gray-500 dark:text-gray-400 py-12 space-y-4">
            <div class="text-5xl text-primary/60">
                <i class="fas fa-handshake-angle"></i>
            </div>
            <h3 class="text-lg font-semibold text-text dark:text-white">
                Belum ada kolaborasi aktif
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                Ayo temukan mitra UMKM untuk menjalin kolaborasi strategis dan kembangkan bisnis bersama!
            </p>
            <a href="{{ route('umkm.umkm-list') }}"
               class="inline-block mt-4 bg-primary hover:bg-primary/80 text-white font-medium px-6 py-2 rounded-xl transition">
                <i class="fas fa-search mr-2"></i> Cari Partner Kolaborasi
            </a>
        </div>
    @endif
</div>
