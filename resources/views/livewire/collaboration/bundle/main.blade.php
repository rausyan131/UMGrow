<div class="space-y-6">

    {{-- Filter --}}

    <div class="flex flex-row justify-between items-center gap-4">
        <div class="space-y-3 xl:space-x-2">
            <button wire:click="$set('filter', 'all')"
                class="px-4 py-1.5 rounded-lg transition-all
                {{ $filter === 'all' ? 'bg-primary text-white' : 'bg-primary/10 border border-primary/20 text-primary hover:bg-primary/10' }}">
                <i class="fas fa-layer-group mr-1"></i> Semua Produk
            </button>
            <button wire:click="$set('filter', 'mine')"
                class="px-4 py-1.5 rounded-lg transition-all
                {{ $filter === 'mine' ? 'bg-primary text-white' : 'bg-primary/10 border border-primary/20 text-primary hover:bg-primary/30' }}">
                <i class="fas fa-user mr-1"></i> Produk Saya
            </button>
            <button wire:click="$set('filter', 'partner')"
                class="px-4 py-1.5 rounded-lg transition-all
                {{ $filter === 'partner' ? 'bg-primary text-white' : 'bg-primary/10 border border-primary/20 text-primary hover:bg-primary/30' }}">
                <i class="fas fa-handshake mr-1"></i> Produk Partner
            </button>
        </div>

        {{-- Aksi Tambahan --}}
        <div class="space-x-2">
            <button wire:click="showAddProduct"
                class="px-4 py-1.5 rounded-lg shadow bg-primary border hover:text-primary border-primary/30 text-white hover:bg-primary/10">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Produk
            </button>

        </div>
    </div>

    @if ($filter === 'mine')
        {{-- Mode Hapus --}}
        <div class="flex justify-between items-center mb-4 mt-2">
            @if (!$deleteMode)
                <button wire:click="enableDeleteMode"
                    class="bg-red-700 text-white px-4 py-1.5 rounded-lg hover:bg-red-800 transition font-semibold text-sm">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus Produk
                </button>
            @else
                <span class="text-sm text-gray-600 dark:text-gray-300 italic flex items-center gap-1">
                    <i class="fas fa-check-double text-primary"></i> Pilih produk yang ingin dihapus
                </span>
            @endif

            @if ($deleteMode)
                <div class="space-x-2">
                    @if (count($selectedProducts) > 0)
                        <button wire:click="confirmDelete"
                            class="bg-red-600 text-white px-4 py-1.5 rounded-lg hover:bg-red-700 transition font-semibold text-sm">
                            <i class="fas fa-trash mr-1"></i> Hapus Terpilih ({{ count($selectedProducts) }})
                        </button>
                    @endif
                    <button wire:click="cancelDelete"
                        class="bg-gray-300 text-gray-800 px-4 py-1.5 rounded-lg hover:bg-gray-400 transition font-semibold text-sm">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                </div>
            @endif
        </div>
    @endif

    <!-- Daftar Produk Kolaborasi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-6">
        @forelse ($collaborationProducts as $item)
            @php
                $product = $item->product;
                $isSelected = in_array($product->id, $selectedProducts);
            @endphp

            <div @if ($deleteMode) wire:click="toggleSelect({{ $product->id }})" @endif
                class="glass p-4 rounded-xl shadow-lg flex flex-col gap-3 transition-all duration-200
                {{ $deleteMode ? 'cursor-pointer hover:scale-[1.02]' : 'cursor-default' }}
                {{ $isSelected ? 'ring-4 ring-primary' : 'ring-0' }}">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="h-32 w-full object-cover rounded-lg border border-gray-200 dark:border-gray-700 transition-all
                        {{ $isSelected ? 'opacity-60 grayscale' : '' }}">
                    @if ($isSelected)
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-white/80 dark:bg-dark/70 px-3 py-1 rounded-full text-sm font-semibold text-primary shadow">
                                <i class="fas fa-check-circle mr-1"></i> Terpilih
                            </div>
                        </div>
                    @endif
                </div>

                <h3 class="font-semibold text-lg text-gray-800 dark:text-white truncate">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                    Pemilik : {{ $product->umkm->umkm_name }}
                </p>

                <div class="flex justify-between items-center mt-auto">
                    <span class="text-primary font-bold text-sm">Rp
                        {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Stok: {{ $product->stock }}</span>
                </div>

            </div>
        @empty
            <div
                class="col-span-full flex flex-col items-center justify-center py-20 text-center text-gray-500 dark:text-gray-300">
                <i class="fas fa-box-open text-5xl mb-4 text-gray-400"></i>
                <h3 class="text-xl font-semibold mb-2">Belum ada produk kolaborasi</h3>
                <p class="text-sm">Produk dari UMKM yang terlibat akan muncul di sini setelah dipilih</p>
            </div>
        @endforelse
    </div>

    {{-- modal create --}}

    @if ($showAddProductModal)
        <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center">
            <div class="bg-white dark:bg-dark p-6 rounded-xl w-full max-w-4xl shadow-xl relative">
                <button wire:click="hideAddProduct"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                    <i class="fas fa-times-circle"></i>
                </button>

                <h2 class="text-lg font-bold mb-4 text-primary">
                    <i class="fas fa-boxes mr-2"></i> Tambah Produk ke Kolaborasi
                </h2>

                <livewire:collaboration.bundle.add-product :collaboration-id="$collaborationId" />

            </div>
        </div>
    @endif


</div>
