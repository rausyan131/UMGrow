<div class="w-full max-w-6xl mx-auto p-6 bg-white dark:bg-dark rounded-2xl shadow-xl space-y-10">

    <div class="flex justify-end">
        <button wire:click="toggleEdit" class="text-sm text-primary hover:underline">
            <i class="fas fa-edit mr-1"></i>{{ $editMode ? 'Batal Edit' : 'Edit Bundling' }}
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Thumbnail + Upload --}}
        <div class="space-y-3">
            <div class="rounded-xl overflow-hidden border border-gray-300 dark:border-gray-700">
                @if ($thumbnailFile)
                    <img src="{{ $thumbnailFile->temporaryUrl() }}" class="w-full h-40 object-cover rounded-xl">
                @elseif ($bundle->thumbnail)
                    <img src="{{ asset('storage/' . $bundle->thumbnail) }}" class="w-full h-40 object-cover rounded-xl">
                @else
                    <div
                        class="h-40 flex items-center justify-center text-gray-400 italic bg-gray-100 dark:bg-gray-800">
                        Belum ada gambar
                    </div>
                @endif
            </div>

            @if ($editMode)
                <div class="relative w-fit">
                    <label
                        class="cursor-pointer inline-flex items-center gap-2 bg-primary text-white px-3 py-1.5 rounded-lg shadow hover:bg-primary/90">
                        <i class="fas fa-image"></i> Ganti Gambar
                        <input type="file" wire:model="thumbnailFile"
                            class="absolute inset-0 opacity-0 cursor-pointer" />
                    </label>
                    @error('thumbnailFile')
                        <span class="text-xs text-red-500 block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        </div>

        {{-- Info Bundle --}}
        <div class="lg:col-span-2 space-y-4">

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-white">Judul</label>
                @if ($editMode)
                    <input type="text" wire:model.defer="title" class="input w-full" />
                    @error('title')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                @else
                    <h2 class="text-2xl font-bold text-primary">{{ $bundle->title }}</h2>
                @endif
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700 dark:text-white">Deskripsi</label>
                @if ($editMode)
                    <textarea wire:model.defer="description" rows="3" class="input w-full"></textarea>
                    @error('description')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                @else
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $bundle->description }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-white">Harga</label>
                    @if ($editMode)
                        <input type="number" wire:model.defer="price" class="input w-full" />
                        @error('price')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    @else
                        <p class="text-xl font-bold text-primary">Rp {{ number_format($bundle->price, 0, ',', '.') }}
                        </p>
                    @endif
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700 dark:text-white">Status</label>
                    @if ($editMode)
                        <select wire:model.defer="status" class="input w-full">
                            <option value="draft">Draf (Belum dipublikasikan)</option>
                            <option value="active">Aktif (Tersedia untuk dibeli)</option>
                            <option value="inactive">Tidak Aktif (Disembunyikan)</option>
                            <option value="archived">Arsip (Disimpan untuk catatan)</option>
                        </select>
                        @error('status')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    @else
                        <p class="text-sm">
                            @php
                                $statusLabel = [
                                    'draft' => 'Draf',
                                    'active' => 'Aktif',
                                    'inactive' => 'Tidak Aktif',
                                    'archived' => 'Arsip',
                                ];
                                $statusColor = [
                                    'draft' => 'text-gray-500',
                                    'active' => 'text-green-600',
                                    'inactive' => 'text-red-500',
                                    'archived' => 'text-yellow-600',
                                ];
                            @endphp
                            <span class="{{ $statusColor[$bundle->status] ?? 'text-gray-500' }}">
                                {{ $statusLabel[$bundle->status] ?? ucfirst($bundle->status) }}
                            </span>
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Catatan --}}
    <div>
        <label class="text-sm font-semibold text-gray-700 dark:text-white">Catatan</label>
        @if ($editMode)
            <textarea wire:model.defer="notes" rows="3" class="input w-full"></textarea>
            @error('notes')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        @elseif ($bundle->notes)
            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $bundle->notes }}</p>
        @endif
    </div>

    {{-- Informasi  --}}
    <div class="text-sm text-gray-500 dark:text-gray-400 text-right space-y-1">
        <p>Dibuat oleh: <strong>{{ $bundle->creator->name ?? '-' }}</strong></p>
        <p>Dibuat: {{ $bundle->created_at->format('d M Y H:i') }}</p>
        @if ($bundle->editor)
            <p>Diedit oleh: <strong>{{ $bundle->editor->name }}</strong></p>
        @endif
        @if ($bundle->updated_at != $bundle->created_at)
            <p>Terakhir diperbarui: {{ $bundle->updated_at->format('d M Y H:i') }}</p>
        @endif
    </div>

    @if ($editMode)
        <div class="flex justify-end">
            <button wire:click="updateBundle"
                class="bg-primary text-white px-5 py-2 rounded-lg shadow hover:bg-primary/90 transition">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    @endif

    {{-- Produk dalam Bundling --}}
    <div class="space-y-3">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Produk dalam Bundling</h3>

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse ($bundle->products as $product)
                <div class="bg-gray-100 dark:bg-dark rounded-lg p-2 shadow border border-gray-300 dark:border-gray-700">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="h-24 w-full object-cover rounded-md mb-1">
                    <div class="text-xs space-y-0.5">
                        <div class="font-semibold text-gray-800 dark:text-white truncate">{{ $product->name }}</div>
                        <div class="text-primary font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="text-gray-500 dark:text-gray-400">Stok: {{ $product->stock }}</div>
                    </div>
                </div>
            @empty
                <p class="italic text-sm text-gray-500 dark:text-gray-400">Belum ada produk dalam bundling ini.</p>
            @endforelse
        </div>
    </div>

</div>
