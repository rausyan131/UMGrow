<div class="max-w-3xl mx-auto p-6 space-y-6">
    <div class="glass p-6 rounded-2xl shadow-lg space-y-6 border border-primary/10">

        {{-- Header: UMKM + Status --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-bold text-text dark:text-white flex items-center gap-2">
                <i class="fas fa-store text-primary"></i>
                {{ $request->partnerUmkm->umkm_name ?? '-' }}
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

        {{-- Box: Ide & Pesan --}}
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



        {{-- Box: Tanggal --}}
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

        <div class="flex justify-end gap-3 pt-4">
            <button onclick="history.back()" class="btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </button>

        </div>
    </div>
</div>
