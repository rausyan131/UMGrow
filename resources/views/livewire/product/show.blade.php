@php
    \Carbon\Carbon::setLocale('id');
@endphp
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="glass p-8 rounded-2xl shadow-2xl grid grid-cols-1 xl:grid-cols-2 gap-12">

        {{-- Gambar Produk --}}
        <div class="flex flex-col items-center justify-center gap-4">
            <div class="bg-white/30 dark:bg-white/10 p-4 rounded-xl border shadow-inner backdrop-blur-sm w-full">
                @if ($editMode && $newImage)
                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview Gambar"
                        class="object-contain w-full max-h-[350px] rounded-xl transition hover:scale-[1.05]" />
                @else
                    <img src="{{ asset('storage/' . $productImage) }}" alt="{{ $name }}"
                        class="object-contain w-full max-h-[350px] rounded-xl transition hover:scale-[1.05]" />
                @endif
            </div>

            @if ($editMode)
                <div class="w-full">
                    <label class="block font-semibold mb-1 text-center">
                        <i class="fas fa-image mr-2"></i>Ganti Gambar Produk
                    </label>
                    <input type="file" wire:model="newImage"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0 file:text-sm file:font-semibold
                            file:bg-primary file:text-white hover:file:bg-primary/90" />
                    @error('newImage')
                        <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        </div>

        {{-- Detail Produk --}}
        <div class="flex flex-col gap-6">
            @if (!$editMode)
                <div>
                    <h2 class="text-3xl font-bold text-primary dark:text-white mb-3">
                        <i class="fas fa-box-open mr-2"></i>{{ $name }}
                    </h2>
                    <p class="text-base text-gray-600 dark:text-gray-300">{{ $description }}</p>
                </div>

                <div class="flex justify-between text-lg font-semibold">
                    <span class="text-primary text-2xl">
                        <i class="fas fa-tags mr-2"></i>Rp {{ number_format($price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-boxes-stacked mr-1"></i>Stok: {{ $stock }}
                    </span>
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    <p><i class="fas fa-calendar-plus mr-2"></i>Dibuat pada: {{ \Carbon\Carbon::parse($createdAt)->translatedFormat('d F Y, H:i') }}</p>
                    <p><i class="fas fa-calendar-check mr-2"></i>Terakhir diubah: {{ \Carbon\Carbon::parse($updatedAt)->diffForHumans() }}</p>
                </div>
                

                <div class="flex gap-4 mt-6">
                    <a href="{{ route('umkm.products') }}"
                        class="flex-1 bg-white/30 dark:bg-white/10 hover:bg-white/50 dark:hover:bg-white/20 text-gray-800 dark:text-white px-5 py-3 rounded-xl text-center font-medium transition shadow">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <button wire:click="toggleEdit"
                        class="flex-1 bg-primary/80 hover:bg-primary text-white px-5 py-3 rounded-xl text-center font-medium transition shadow">
                        <i class="fas fa-edit mr-2"></i>Edit Produk
                    </button>
                </div>
            @else
                {{-- Mode Edit --}}
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block font-semibold mb-1">
                            <i class="fas fa-box mr-2"></i>Nama Produk
                        </label>
                        <input type="text" wire:model.defer="name"
                            class="w-full rounded-xl border border-gray-300 p-3 bg-white/40 dark:bg-dark text-black dark:text-white shadow-inner backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-primary" />
                        @error('name')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">
                            <i class="fas fa-align-left mr-2"></i>Deskripsi
                        </label>
                        <textarea wire:model.defer="description" rows="4"
                            class="w-full rounded-xl border border-gray-300 p-3 bg-white/40 dark:bg-dark text-black dark:text-white shadow-inner backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        @error('description')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2" x-data="rupiahInput()" x-init="init({{ $price ?? 0 }})">
                            <label class="block font-semibold mb-1">
                                <i class="fas fa-money-bill mr-2"></i>Harga
                            </label>

                            <input type="text" x-model="formatted" x-on:input="format()"
                                class="w-full rounded-xl border border-gray-300 p-3 bg-white/40 dark:bg-dark text-black dark:text-white shadow-inner backdrop-blur-md" />

                            <input type="hidden" wire:model.defer="price" :value="numeric" />

                            @error('price')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="block font-semibold mb-1">
                                <i class="fas fa-cubes mr-2"></i>Stok
                            </label>
                            <input type="number" wire:model.defer="stock"
                                class="w-full rounded-xl border border-gray-300 p-3 bg-white/40 dark:bg-dark text-black dark:text-white shadow-inner backdrop-blur-md" />
                            @error('stock')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="button" wire:click="cancelEdit"
                            class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 px-5 py-3 rounded-xl font-medium transition shadow">
                            <i class="fas fa-times-circle mr-2"></i>Batal
                        </button>

                        <button type="submit"
                            class="flex-1 bg-primary/80 hover:bg-primary text-white px-5 py-3 rounded-xl font-medium transition shadow">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mt-6 text-green-600 dark:text-green-400 font-semibold text-center">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif
</div>

<x-slot name='scripts'>
    <script>
        function rupiahInput() {
            return {
                numeric: 0,
                formatted: '',
                init(value) {
                    this.numeric = value;
                    this.formatted = this.formatRupiah(value);
                },
                format() {
                    let clean = this.formatted.replace(/[^\d]/g, '');
                    this.numeric = parseInt(clean) || 0;
                    this.formatted = this.formatRupiah(this.numeric);
                },
                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                    }).format(number);
                }
            }
        }
    </script>
</x-slot>    
