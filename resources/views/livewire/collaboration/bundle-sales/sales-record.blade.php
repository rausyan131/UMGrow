<div class="space-y-6">
    <!-- Search & Action Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex gap-2 w-full md:w-auto">
            <input type="text" wire:model.defer="search"
                class="px-4 py-2 rounded-lg border w-full md:w-64 dark:bg-dark dark:text-white dark:border-gray-700"
                placeholder="Cari nama bundle...">
            <input type="date" wire:model.defer="searchDate"
                class="px-4 py-2 rounded-lg border dark:bg-dark dark:text-white dark:border-gray-700">
            <button wire:click="searchNow"
                class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                <i class="fas fa-search mr-1"></i> Cari
            </button>
        </div>

        <button wire:click="toggleModal"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
            <i class="fas fa-plus mr-1"></i> Tambah Penjualan
        </button>
    </div>

    <!-- Sales Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border dark:border-white/30 border-gray-400  rounded-lg overflow-hidden">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Bundle</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Total Harga</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-dark divide-y dark:divide-gray-700">
                @forelse($sales as $sale)
                    <tr>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sale->sold_at)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $sale->bundle->title }}</td>
                        <td class="px-4 py-2">{{ $sale->quantity }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="openSaleDetail({{ $sale->id }})"
                                class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">
                                Detail
                            </button>

                        </td>
             

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Belum ada
                            catatan penjualan...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Penjualan -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
            <div class="bg-white dark:bg-dark w-full max-w-lg p-6 rounded-xl shadow-lg relative">
                <h2 class="text-xl font-semibold mb-4 dark:text-white">Tambah Catatan Penjualan</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold mb-1 dark:text-white">Bundle</label>
                        <select wire:model="bundle_id"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-dark dark:text-white dark:border-gray-700">
                            <option value="">Pilih Bundle</option>
                            @foreach ($bundles as $b)
                                <option value="{{ $b->id }}">{{ $b->title }}</option>
                            @endforeach
                        </select>
                        @error('bundle_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 dark:text-white">Jumlah</label>
                        <input type="number" wire:model="quantity"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-dark dark:text-white dark:border-gray-700"
                            min="1">
                        @error('quantity')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 dark:text-white">Tanggal Penjualan</label>
                        <input type="date" wire:model="sold_at"
                            class="w-full border rounded-lg px-3 py-2 dark:bg-dark dark:text-white dark:border-gray-700">
                        @error('sold_at')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6 gap-2">
                    <button wire:click="toggleModal"
                        class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600">
                        Batal
                    </button>
                    <button wire:click="save" class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- modal detail --}}

    @if ($showDetailModal && $selectedSaleId)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
            <div class="bg-white dark:bg-dark rounded-xl w-full max-w-3xl p-6 shadow-xl relative">
                <button wire:click="closeSaleDetail"
                    class="absolute top-4 right-4 bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                    ✕
                </button>

                <livewire:collaboration.bundle-sales.sales-record-detail :saleId="$selectedSaleId" />
            </div>
        </div>
    @endif




</div>
