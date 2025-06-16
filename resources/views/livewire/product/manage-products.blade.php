<div class="flex flex-col-reverse xl:flex-row w-full xl:h-[calc(100vh-150px)] gap-6" wire:key="manageProducts">
    <div class="w-full xl:w-2/3 flex flex-col p-4 sm:p-6 overflow-hidden  dark:bg-dark min-h-[300px]">


        <div class="space-y-6 overflow-auto flex-grow pr-1">
            <!-- Header -->
            <div
                class="flex flex-wrap justify-between items-center gap-4 p-2 mb-10 pb-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-wrap gap-4 items-center">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari produk..."
                            class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition w-64 text-sm"
                            wire:model.defer="search">
                    </div>

                    <div class="relative">
                        <i
                            class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="date"
                            class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition text-sm"
                            wire:model.defer="filterDate">
                    </div>

                    <div class="flex gap-2 items-center">
                        <button wire:click="searchProducts" class="btn-primary rounded-lg transition px-4 py-2 text-sm">
                            <i class="fas fa-search"></i>
                        </button>
                        <div wire:loading wire:target="searchProducts">
                            <svg class="animate-spin h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 items-center">

                    <button wire:click="toggleDeleteMode"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200
                        {{ !$deleteMode ? 'bg-red-700 text-white hover:bg-red-800' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                        <i class="fas {{ !$deleteMode ? 'fa-trash-alt' : 'fa-times' }}"></i>
                        <span>{{ !$deleteMode ? 'Hapus Produk' : 'Batal' }}</span>
                    </button>

                    @if ($deleteMode && count($selectedProducts) > 0)
                        <button wire:click="deleteSelected"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition-all shadow">
                            <i class="fas fa-check-circle"></i>
                            <span>Hapus Terpilih ({{ count($selectedProducts) }})</span>
                        </button>
                    @endif

                    @if ($deleteMode)
                        <div class="flex items-center gap-2 text-sm italic text-gray-600 dark:text-gray-300">
                            <i class="fas fa-mouse-pointer text-primary"></i>
                            <span>Klik produk untuk memilih</span>
                        </div>
                    @endif

                </div>

            </div>

            <!-- daftar produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-6 ">
                @forelse ($products as $product)
                    @php $isSelected = in_array($product->id, $selectedProducts); @endphp
                    <div @if ($deleteMode) wire:click="toggleSelect({{ $product->id }})" @endif
                        class="glass p-4 rounded-xl shadow-lg flex flex-col gap-3 transition-all duration-200
                        {{ $deleteMode ? 'cursor-pointer hover:scale-[1.02]' : 'cursor-default' }}
                        {{ $isSelected ? 'ring-4 ring-primary' : 'ring-0' }}">

                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="h-32 w-full object-cover rounded-lg border border-gray-200 dark:border-gray-700 transition-all {{ $isSelected ? 'opacity-50 ' : '' }}">
                            @if ($isSelected)
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div
                                        class="bg-white/80 dark:bg-dark/70 px-3 py-1 rounded-full text-sm font-semibold text-primary shadow">
                                        <i class="fas fa-check-circle mr-1"></i> Terpilih
                                    </div>
                                </div>
                            @endif
                        </div>

                        <h3 class="font-semibold text-lg text-gray-800 dark:text-white truncate">{{ $product->name }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                            {{ Str::limit($product->description, 50) }}</p>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-primary font-bold text-sm">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Stok: {{ $product->stock }}</span>
                        </div>
                        <a href="{{ route('product.detail', ['product' => $product->id]) }}"
                            class="mt-3 inline-block text-sm dark:text-white bg-dark/20 dark:bg-white/40 px-3 py-1 rounded hover:bg-primary/90 transition text-center">
                            Detail
                        </a>
                    </div>
                @empty
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-20 text-center text-gray-500 dark:text-gray-300">
                        <i class="fas fa-box-open text-5xl mb-4 text-gray-400"></i>
                        <h3 class="text-xl font-semibold mb-2">Belum ada produk </h3>
                        <p class="text-sm">Tambahkan produk pertamamu sekarang</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-10 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between flex-wrap gap-4 text-sm">
                @if ($products->onFirstPage())
                    <span class="px-4 py-2 text-gray-400 rounded-xl shadow-inner glass">← Prev</span>
                @else
                    <button wire:click="previousPage"
                        class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition">
                        ← Prev
                    </button>
                @endif

                <div class="flex gap-2">
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span
                                class="px-4 py-2 rounded-xl bg-gray-200 text-gray-800  shadow glass">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                </div>

                @if ($products->hasMorePages())
                    <button wire:click="nextPage"
                        class="px-4 py-2 rounded-xl bg-white/30 dark:bg-white/10 text-gray-800 dark:text-white shadow glass hover:bg-white/50 dark:hover:bg-white/20 transition">
                        Next →
                    </button>
                @else
                    <span class="px-4 py-2 text-gray-400 rounded-xl shadow-inner glass">Next →</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Form Tambah Produk -->
    <div
        class="w-full xl:w-1/3 p-4 sm:p-6 overflow-y-auto space-y-6 max-h-[calc(100vh-150px)] min-h-[300px] glass glass dark:bg-dark">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Produk</h2>
        <form wire:submit.prevent="save" class="space-y-5">
            @foreach ([['label' => 'Nama Produk', 'model' => 'name', 'type' => 'text'], ['label' => 'Harga', 'model' => 'price', 'type' => 'number'], ['label' => 'Stok', 'model' => 'stock', 'type' => 'number']] as $field)
                <div>
                    <label
                        class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $field['label'] }}</label>
                    <input wire:key="{{ $formKey }}" type="{{ $field['type'] }}"
                        wire:model="{{ $field['model'] }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition">
                    @error($field['model'])
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea wire:key="{{ $formKey }}" wire:model="description"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition"></textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Produk</label>
                <div
                    class="relative h-48 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center bg-white/30 dark:bg-white/10 overflow-hidden backdrop-blur-sm transition">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover rounded-xl">
                    @else
                        <div class="text-center text-gray-500 dark:text-gray-400 flex flex-col items-center">
                            <i class="fas fa-upload text-3xl mb-1"></i>
                            <p class="text-sm">Klik untuk unggah gambar</p>
                        </div>
                    @endif
                    <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer"
                        title="Unggah Gambar">
                </div>
                @error('image')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary shadow">Simpan</button>
            </div>
        </form>
    </div>
</div>
