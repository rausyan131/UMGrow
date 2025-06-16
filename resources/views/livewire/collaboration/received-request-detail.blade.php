<div class="max-w-3xl mx-auto p-6 space-y-6">
    <div class="glass p-10 rounded-2xl shadow-lg space-y-6 border border-primary/10">

        {{-- UMKM , Status --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-bold text-text dark:text-white flex items-center gap-2">
                <i class="fas fa-store text-primary"></i>
                {{ $request->fromUmkm->umkm_name ?? '-' }}
            </h1>

            <div
                class="text-sm font-semibold px-3 py-1 rounded-full inline-flex items-center gap-2
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
            </div>
        </div>

        {{--  Ide & Pesan --}}
        <div
            class="bg-white/50 dark:bg-dark border border-gray-200 dark:border-gray-700 rounded-bl-xl rounded-tr-xl p-4 space-y-4 shadow-inner">
            <div>
                <p class="font-semibold text-sm text-primary mb-1">
                    <i class="fas fa-lightbulb mr-1"></i> Ide Kolaborasi
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $request->ideas ?? '-' }}</p>
            </div>
        </div>

        <div
            class="bg-white/50 dark:bg-dark rounded-bl-xl rounded-tr-xl p-4 space-y-4 shadow-inner border border-gray-200 dark:border-gray-700">
            <div>
                <p class="font-semibold text-sm text-primary mb-1">
                    <i class="fas fa-comment-dots mr-1"></i> Pesan
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $request->message ?? '-' }}</p>
            </div>
        </div>

        {{-- Produk Terkait --}}
        @if ($request->products->count())
            <div class="space-y-2">
                <p class="font-semibold text-sm text-primary">
                    <i class="fas fa-box mr-1"></i> Produk yang Dilibatkan
                </p>
                <div
                    class="flex overflow-x-auto gap-4 py-2 scroll-smooth scrollbar-thin scrollbar-thumb-primary/40 scrollbar-track-transparent">
                    @foreach ($request->products as $product)
                        <div
                            class="min-w-[200px] bg-white dark:bg-dark p-4 rounded-xl shadow border border-primary/10 hover:border-primary transition flex-shrink-0">
                            <div
                                class="w-full h-32 bg-gray-100 dark:bg-dark rounded-md overflow-hidden flex items-center justify-center">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="object-contain h-full max-h-32" />
                            </div>
                            <div class="mt-3 space-y-1">
                                <h3 class="text-sm font-semibold text-text dark:text-white">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Tanggal --}}
        <div class="flex flex-col gap-4 p-4 text-sm text-gray-700 dark:text-gray-300">
            <div class="flex items-start gap-2">
                <i class="fas fa-calendar-plus text-primary mt-1"></i>
                <div>
                    <p class="font-semibold">Dimulai</p>
                    <p>{{ $request->started_at ?? '-' }}</p>
                </div>
            </div>

            <div class="flex items-start gap-2">
                <i class="fas fa-calendar-check text-primary mt-1"></i>
                <div>
                    <p class="font-semibold">Berakhir</p>
                    <p>{{ $request->ended_at ?? '-' }}</p>
                </div>
            </div>
        </div>

        @if ($request->status === 'pending')
            <div class="flex justify-end gap-3 pt-4">
                <button wire:click="rejectConfirmation" class="bg-red-500 px-4 py-2 rounded-bl-lg rounded-tr-lg text-white hover:bg-red-600 transition-all ease-in-out">
                    <i class="fas fa-times-circle mr-1"></i> Tolak
                </button>
                <button wire:click="accept" class="bg-green-500 px-4 py-2 rounded-bl-lg rounded-tr-lg text-white hover:bg-green-600  transition-all ease-in-out">
                    <i class="fas fa-check-circle mr-1"></i> Terima
                </button>
            </div>
        @endif

        {{-- Modal rejection --}}

        @if ($showRejectModal)
            <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center" x-data="{
                addTo(text) {
                    let area = $refs.reason;
                    let current = area.value.trim();
                    if (current && !current.endsWith('.')) current += '.';
                    area.value = (current ? current + ' ' : '') + text;
                    area.dispatchEvent(new Event('input')); // biar Livewire tahu ada perubahan
                }
            }">
                <div class="bg-white dark:bg-dark rounded-xl p-6 shadow-xl w-full max-w-lg space-y-4">
                    <h2 class="text-lg font-bold">Alasan Penolakan</h2>

                    <div class="flex flex-wrap gap-2">
                        <span
                            @click="addTo('Terima kasih atas ajakan kolaborasinya, namun saat ini kami belum bisa bergabung karena prioritas internal.')"
                            class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                            Prioritas internal belum memungkinkan
                        </span>
                        <span
                            @click="addTo('Kami menghargai ajakan ini, namun kolaborasi belum sesuai dengan arah strategi usaha kami.')"
                            class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                            Belum sesuai strategi usaha
                        </span>
                        <span
                            @click="addTo('Fokus kami saat ini masih di pengembangan produk utama. Semoga bisa bekerjasama di lain waktu.')"
                            class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                            Masih fokus pengembangan
                        </span>
                    </div>

                    <textarea wire:model.defer="rejectionReason" x-ref="reason" rows="4"
                        class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg resize-none"
                        ></textarea>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-3">
                        <button wire:click="cancelReject" class="btn-primary">Batal</button>
                        <button wire:click="confirmReject" class="bg-red-500 px-4 py-2 rounded-bl-lg rounded-tr-lg text-white hover:bg-red-600 transition-all ease-in-out">Tolak Permintaan</button>
                    </div>
                </div>
            </div>
        @endif


        <div class="flex justify-end pt-4">
            <button onclick="history.back()" class="btn-primary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </button>
        </div>
    </div>
</div>
