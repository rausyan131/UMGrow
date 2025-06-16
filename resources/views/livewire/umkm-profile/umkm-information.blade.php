<div class="flex flex-col xl:flex-row gap-6 ">

    {{-- Profil dan Info Kolaborasi --}}
    <div class="bg-white dark:bg-dark glass p-6 flex flex-col xl:flex-row xl:items-stretch gap-6 flex-1">

        {{-- Foto --}}
        <div class="shrink-0 mx-auto xl:mx-0">
            <img src="{{ $umkm->image ? asset('storage/umkm/profile/' . $umkm->image) : asset('images/profile.png') }}"
                alt="Foto UMKM"
                class="rounded-full w-32 h-32 md:w-44 md:h-44 object-cover border-4 border-primary shadow" />
        </div>

        {{-- Info UMKM --}}
        <div class="flex-1 flex flex-col gap-2 items-center xl:items-start mx-auto xl:mx-0 text-center xl:text-left">
            <h1 class="text-2xl font-bold text-text dark:text-white">{{ $umkm->umkm_name }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300">Pemilik: {{ $umkm->user->name ?? '-' }}</p>
            @if ($umkm->location)
                <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                    {{ $umkm->location }}
                </p>
            @endif

            {{-- Kategori --}}
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
                <a href="{{ route('profile.edit') }}" class="btn-primary">
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- Info Kolaborasi --}}
        <div class="flex flex-col justify-center items-center text-center gap-2 self-center p-6 xl:pl-4 w-full xl:w-auto">
            <div class="text-primary text-4xl font-bold">10</div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Kolaborasi Aktif</p>
            <a href="#" class="btn-primary mt-2">Lihat Detail</a>
        </div>
    </div>

    {{-- Kelengkapan Profil --}}
    
    @if (!$is_complete)
        <div class="bg-white dark:bg-dark glass p-6 flex flex-col items-center gap-4 w-full xl:w-[16rem]">
            <div class="relative w-24 h-24">
                <svg class="w-full rotate-[-90deg]" viewBox="0 0 36 36">
                    <path class="text-gray-300/20" stroke="currentColor" stroke-width="3" fill="none"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-orange-400" stroke="currentColor" stroke-width="3"
                        stroke-dasharray="{{ $progress ?? 0 }}, 100" fill="none"
                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-sm font-bold text-primary">{{ $progress ?? 0 }}%</span>
                </div>
            </div>
            <h2 class="text-sm font-semibold text-text dark:text-white">Kelengkapan Profil</h2>
            <a href="{{ route('profile.edit') }}" class="btn-primary">
                Lengkapi Sekarang
            </a>
        </div>
    @endif

</div>
