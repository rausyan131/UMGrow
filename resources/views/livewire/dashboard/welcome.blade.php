<div class="w-full lg:w-[80%] xl:w-[60%] glass flex flex-col lg:flex-row justify-between items-center p-8 gap-6 my-shadow">
    <div class="space-y-6 text-center lg:text-left">
        <div>
            <h1 class="text-4xl lg:text-5xl font-bold">Selamat Datang</h1>
            <p class="text-2xl lg:text-3xl font-bold text-primary">{{ $username }}</p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
            <a wire:navigate href="{{route('profile.edit')}}" class="border bg-primary text-white px-6 py-2 rounded-3xl hover:bg-primary/90 transition-all">
                Edit Profile UMKM
            </a>
            <a wire:navigate href="{{ route('profile.detail-umkm') }}"
               class="border border-primary text-primary px-6 py-2 rounded-3xl hover:bg-primary/10 transition-all">
                Lihat UMKM Saya
            </a>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center">
        <p class="text-base lg:text-lg font-semibold mb-2">Progress Profil UMKM</p>
        <div class="relative w-36 h-36 sm:w-44 sm:h-44">
            <svg class="w-full h-full rotate-[-90deg]" viewBox="0 0 36 36">
                <path class="text-gray-300/20" stroke="currentColor" stroke-width="4" fill="none"
                      d="M18 2.0845
                         a 15.9155 15.9155 0 0 1 0 31.831
                         a 15.9155 15.9155 0 0 1 0 -31.831" />
                <path class="text-orange-400" stroke="currentColor" stroke-width="4"
                      stroke-dasharray="{{ $progress }}, 100" fill="none"
                      d="M18 2.0845
                         a 15.9155 15.9155 0 0 1 0 31.831
                         a 15.9155 15.9155 0 0 1 0 -31.831" />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-xl font-bold text-primary">{{ $progress }}%</span>
            </div>
        </div>
    </div>
</div>
