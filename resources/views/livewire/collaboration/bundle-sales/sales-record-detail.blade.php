<div>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 dark:bg-black/70">
        <div class="bg-white dark:bg-dark rounded-xl shadow-xl w-full max-w-2xl p-6 space-y-4">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold dark:text-white">Detail Penjualan Bundle</h2>
                <button wire:click="closeModal" class="text-gray-600 hover:text-red-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Isi Detail --}}
            <div class="space-y-4 text-sm">
                {{-- Tanggal --}}
                <div>
                    <label class="block font-semibold mb-1 dark:text-white">Tanggal Jual</label>
                    <input type="date" wire:model.defer="sold_at"
                        class="w-full border rounded-lg px-3 py-2 dark:bg-dark dark:text-white dark:border-gray-700">
                    @error('sold_at') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Jumlah Terjual --}}
                <div>
                    <label class="block font-semibold mb-1 dark:text-white">Jumlah Terjual</label>
                    <input type="number" min="1" wire:model.defer="quantity"
                        class="w-full border rounded-lg px-3 py-2 dark:bg-dark dark:text-white dark:border-gray-700">
                    @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Total Harga --}}
                <div>
                    <label class="block font-semibold mb-1 dark:text-white">Total Harga</label>
                    <div class="text-gray-800 dark:text-white">
                        Rp{{ number_format($sale->bundle->price * $quantity, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Produk dalam Bundle --}}
                <hr class="border-gray-300 dark:border-gray-600">

                <h3 class="font-semibold dark:text-white">Produk dalam Bundle:</h3>
                <ul class="list-disc list-inside pl-4 text-gray-700 dark:text-gray-300">
                    @foreach ($sale->bundle->products as $item)
                        <li>{{ $item->name }} — stok sekarang: {{ $item->stock }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end mt-4 gap-2">
                <button wire:click="$set('confirmingDelete', true)"
                    class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                    Hapus
                </button>
                <button wire:click="closeModal"
                    class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button wire:click="saveEdit"
                    class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90">
                    Simpan Perubahan
                </button>
            </div>
            
        </div>
    </div>

        {{-- modal confirm delete --}}
        @if ($confirmingDelete)
        <div class="fixed inset-0 bg-black/60 z-60 flex items-center justify-center">
            <div class="bg-white dark:bg-dark p-6 rounded-xl w-full max-w-sm shadow-lg space-y-4 text-center">
                <h2 class="text-lg font-semibold dark:text-white">Hapus Penjualan?</h2>
                <p class="text-sm text-gray-600 dark:text-gray-300">Data akan dihapus permanen dan stok akan dikembalikan.</p>
    
                <div class="flex justify-center gap-4 mt-4">
                    <button wire:click="$set('confirmingDelete', false)"
                        class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600">
                        Batal
                    </button>
                    <button wire:click="deleteSale"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif
    
</div>
