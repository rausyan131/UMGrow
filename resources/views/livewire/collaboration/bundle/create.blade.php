<div class="flex flex-col lg:flex-row gap-6 p-4 w-full">
    {{-- Bagian Kiri: Produk Saya & Partner --}}
    <div class="flex-1 space-y-6 overflow-hidden">

        {{-- Pencarian Produk --}}
        <div class="flex gap-3 items-center sticky top-0 z-10 bg-white dark:bg-dark pb-2">
            <input wire:model.defer="search" type="text" placeholder="Cari produk..."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm dark:bg-dark dark:text-white">
            <button wire:click="$refresh"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition">
                <i class="fas fa-search mr-2"></i> Cari
            </button>
        </div>

        {{-- Produk Saya --}}
        <div class="space-y-3">
            <h2 class="text-primary font-bold text-base"><i class="fas fa-boxes mr-1"></i> Produk Saya</h2>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2 max-w-full">
                @forelse($myProducts as $product)
                    @php $isSelected = in_array($product->id, $selectedProducts); @endphp

                    <div wire:click="toggleSelect({{ $product->id }})"
                        class="glass min-w-[200px] max-w-[200px] p-4 rounded-xl shadow-lg flex flex-col gap-3 cursor-pointer hover:scale-[1.02] transition
                            {{ $isSelected ? 'ring-4 ring-primary' : 'ring-0' }}">

                        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg border">
                            <img loading="lazy" src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover transition {{ $isSelected ? 'opacity-60 grayscale' : '' }}">

                            @if ($isSelected)
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div
                                        class="bg-white/80 px-3 py-1 rounded-full text-sm font-semibold text-primary shadow">
                                        <i class="fas fa-check-circle mr-1"></i> Terpilih
                                    </div>
                                </div>
                            @endif
                        </div>

                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white truncate">
                            {{ $product->name }}
                        </h3>
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white truncate">
                            {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}

                        </h3>


                        <div class="text-xs text-gray-500"><i class="fas fa-cubes mr-1"></i>Stok:
                            {{ $product->stock }}
                        </div>
                    </div>
                @empty
                    <div class="w-full flex flex-col items-center justify-center text-center text-gray-400 py-6">
                        <i class="fas fa-store-slash text-4xl mb-2 text-gray-300"></i>
                        <p class="text-sm italic">Belum ada produk dari kamu</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Produk Partner --}}
        <div class="space-y-3">
            <h2 class="text-pink-600 font-bold text-base"><i class="fas fa-handshake mr-1"></i> Produk Partner</h2>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2 max-w-full">
                @forelse($partnerProducts as $product)
                    @php $isSelected = in_array($product->id, $selectedProducts); @endphp

                    <div wire:click="toggleSelect({{ $product->id }})"
                        class="glass min-w-[200px] max-w-[200px] p-4 rounded-xl shadow-lg flex flex-col gap-3 cursor-pointer hover:scale-[1.02] transition
                            {{ $isSelected ? 'ring-4 ring-gray-400' : 'ring-0' }}">

                        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg border">
                            <img loading="lazy" src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover transition {{ $isSelected ? 'opacity-60 grayscale' : '' }}">
                            @if ($isSelected)
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div
                                        class="bg-white/80 px-3 py-1 rounded-full text-sm font-semibold text-gray-400 shadow">
                                        <i class="fas fa-check-circle mr-1"></i> Terpilih
                                    </div>
                                </div>
                            @endif
                        </div>

                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white truncate">
                            {{ $product->name }}
                        </h3>
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white truncate">
                            {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}

                        </h3>
                        <div class="text-xs text-gray-500"><i class="fas fa-cubes mr-1"></i>
                            Stok: {{ $product->stock }}
                        </div>
                    </div>
                @empty
                    <div class="w-full flex flex-col items-center justify-center text-center text-gray-400 py-6">
                        <i class="fas fa-store-slash text-4xl mb-2 text-gray-300"></i>
                        <p class="text-sm italic">Partner belum punya produk </p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-2 mt-10">
            <h3 class="text-sm font-bold text-primary"><i class="fas fa-check-double mr-1"></i> Produk Terpilih</h3>

            @if (count($selectedProductModels) > 0)
                <ul class="space-y-2 max-h-[300px] overflow-y-auto pr-2 flex justify-center items-center gap-4 ">
                    @foreach ($selectedProductModels as $p)
                        <li class="flex items-start gap-3 px-3 py-2 ">
                            <img src="{{ asset('storage/' . $p->image) }}" class="w-12 h-12 object-cover rounded-md ">
                            <div>
                                <p class="font-semibold text-sm text-gray-800 dark:text-white">{{ $p->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-300">
                                    <i class="fas fa-tag mr-1"></i>Rp {{ number_format($p->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm italic text-gray-500">Belum ada produk dipilih</p>
            @endif
        </div>
    </div>

    <div class="w-full lg:w-[300px] bg-white dark:bg-dark border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow space-y-4">

        {{-- ✍️ Form Input Bundle --}}
        <div class="space-y-3">
            <h3 class="text-sm font-bold text-primary"><i class="fas fa-gift mr-1"></i> Info Bundling</h3>
    
            {{-- Judul --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Judul</label>
                <input type="text" wire:model.defer="title"
                    class="w-full mt-1 px-3 py-2 text-sm border rounded-lg shadow-sm dark:bg-dark dark:text-white border-gray-300 dark:border-gray-600" />
                @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
    
            {{-- Deskripsi --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Deskripsi</label>
                <textarea wire:model.defer="description" rows="2"
                    class="w-full mt-1 px-3 py-2 text-sm border rounded-lg shadow-sm dark:bg-dark dark:text-white border-gray-300 dark:border-gray-600"></textarea>
                @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
    
            {{-- Harga --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Harga Bundling</label>
                <input type="number" wire:model.defer="price"
                    class="w-full mt-1 px-3 py-2 text-sm border rounded-lg shadow-sm dark:bg-dark dark:text-white border-gray-300 dark:border-gray-600" />
                @error('price') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
    
            {{-- Thumbnail Upload + Preview --}}
            <div>
                <label class="text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1 block">Thumbnail</label>
                <div class="relative group cursor-pointer w-full aspect-[4/3] bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-primary/80">
                    <label for="upload-thumbnail" class="w-full h-full block">
                        @if ($thumbnailPreview)
                            <img src="{{ $thumbnailPreview }}" class="w-full h-full object-cover" />
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                <i class="fas fa-image fa-2x mb-1"></i>
                                <span class="text-xs">Klik untuk pilih gambar</span>
                            </div>
                        @endif
                    </label>
                    <input type="file" id="upload-thumbnail" wire:model="thumbnailFile" accept="image/*" class="hidden" />
                </div>
                @error('thumbnailFile') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    
        {{-- 🌟 Tombol Simpan --}}
        <div class="pt-3">
            <button wire:click="saveBundle"
                class="w-full bg-primary hover:bg-primary/80 text-white font-semibold py-2 px-4 rounded-lg transition">
                <i class="fas fa-plus mr-1"></i> Tambah Bundling
            </button>
        </div>
    </div>
    
</div>
