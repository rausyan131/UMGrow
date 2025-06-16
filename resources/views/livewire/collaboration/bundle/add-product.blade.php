<div class="space-y-6">
    {{-- Pencarian --}}
    <div class="flex items-center gap-3">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari produk kamu..."
            class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-primary/50 dark:bg-dark dark:text-white">
        <button wire:click="$refresh"
            class="text-gray-500 hover:text-primary transition px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600"
            title="Cari produk">
            <i class="fas fa-search"></i>
        </button>
    </div>

    {{-- Daftar Produk dan Preview --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-white">Daftar Produk Saya</h2>

            @forelse ($myProducts as $product)
                <div wire:click="selectProduct({{ $product->id }})"
                    class="cursor-pointer border p-2 rounded {{ $selectedProductId === $product->id ? 'bg-primary/10 border-primary text-primary' : '' }}">
                    <i class="fas fa-box mr-2"></i>{{ $product->name }}
                </div>
            @empty
                <div class="text-center text-sm text-gray-500 italic">Tidak ada produk yang tersedia.</div>
            @endforelse
        </div>

        {{-- Preview Produk --}}
        <div>
            @if ($selectedProduct)
                <div class="glass p-4 rounded-xl shadow space-y-3">
                    <img src="{{ asset('storage/' . $selectedProduct->image) }}"
                        class="h-40 w-full object-cover rounded-lg border border-gray-200 dark:border-gray-600"
                        alt="Preview Produk">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $selectedProduct->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $selectedProduct->description }}</p>
                        <div class="text-sm font-semibold text-primary mt-2">
                            Rp {{ number_format($selectedProduct->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-sm text-gray-500 italic">Klik salah satu produk untuk melihat detailnya.</div>
            @endif
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="flex justify-end pt-2">
        <button wire:click="addToCollaboration"
            class="bg-primary text-white px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2 {{ !$selectedProductId ? 'opacity-50 cursor-not-allowed' : '' }}"
            @if (!$selectedProductId) disabled @endif>
            <i class="fas fa-plus-circle"></i> Tambah ke Kolaborasi
        </button>
    </div>

    {{-- Pesan Error --}}
    @error('error')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>