<div class="space-y-6 p-6 max-w-4xl mx-auto">

    {{-- header --}}
    <div
        class="flex flex-col md:flex-row items-center gap-4 w-full mb-10 pb-6 border-b border-gray-200 dark:border-gray-700">
        {{-- Input Search --}}
        <div class="w-full flex-1 md:w-1/2">
            <input type="text" wire:model="searchInput" placeholder="Cari berdasarkan nama UMKM..."
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary">
        </div>

        {{-- Filter Status --}}
        <div class="w-full md:w-1/4">
            <select wire:model="statusInput"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">Rejected</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        {{-- search btn --}}
        <div>
            <div class="flex flex-1 gap-2 items-center">

                <button wire:click="search"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:bg-primary/90 transition">
                    <i class="fas fa-search"></i>
                    Cari
                </button>

                <div wire:loading wire:target="search" class="flex items-center">
                    <svg class="animate-spin h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Data List --}}
    @if ($requests->isEmpty())
        @if (empty($searchInput) && empty($statusInput))
            <div class=" p-8 rounded-xl text-center text-gray-400 italic my-shadow glass">
                <i class="fas fa-paper-plane text-4xl mb-4 text-primary"></i>
                <p class="text-lg font-semibold text-gray-500 dark:text-gray-300">Belum ada pengajuan kolaborasi</p>
                <p>Ayo Ajukan Kolaborasi sekarang!</p>
            </div>
        @else
            <div class="glass p-8 rounded-xl text-center text-gray-400 italic shadow-md">
                <i class="fas fa-search text-4xl mb-4 text-primary"></i>
                <p class="text-lg font-semibold text-gray-500 dark:text-gray-300">Hasil tidak ditemukan</p>
                <p>
                    Tidak ada kolaborasi yang cocok dengan pencarian <strong>"{{ $searchInput }}"</strong>
                    @if ($statusInput)
                        dan status <strong>"{{ ucfirst($statusInput) }}"</strong>
                    @endif.
                </p>
            </div>
        @endif
    @else
        @foreach ($requests as $request)
            <div
                class="p-5 shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition hover:shadow-lg glass bg-gray border-none">
                <a href="{{ route('collaboration.sent-request.detail', $request->id) }}" class="w-full">

                    <div class="w-full flex justify-between px-5 items-center">
                        <div class="space-y-2 flex gap-6 items-center">
                            <i class="fas fa-handshake text-primary text-3xl"></i>
                            <div>

                            <h2 class="text-lg font-semibold text-text dark:text-white flex items-center gap-2">
                                Kepada: {{ $request->partnerUmkm->umkm_name ?? 'UMKM Tidak Ditemukan' }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Illuminate\Support\Str::limit($request->message, 100) }}
                            </p>
                        </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                         
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full font-semibold text-xs
                            {{ match ($request->status) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'accepted' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'completed' => 'bg-blue-100 text-blue-800',
                                'cancelled' => 'bg-gray-200 text-gray-800',
                            } }}">
                                {!! match ($request->status) {
                                    'pending' => '<i class="fas fa-hourglass-half"></i> Pending',
                                    'accepted' => '<i class="fas fa-check-circle"></i> Accepted',
                                    'rejected' => '<i class="fas fa-times-circle"></i> Rejected',
                                    'completed' => '<i class="fas fa-flag-checkered"></i> Completed',
                                    'cancelled' => '<i class="fas fa-ban"></i> Cancelled',
                                } !!}
                            </span>
                        </div>
                    </div>


                </a>
            </div>
        @endforeach
    @endif
</div>
