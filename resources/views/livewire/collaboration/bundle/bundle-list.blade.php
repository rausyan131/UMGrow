<div class="space-y-6">

    {{-- header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div class="flex flex-col md:flex-row md:items-center md:gap-4 gap-3 w-full">
            <div class="flex flex-wrap gap-2">

                <button wire:click="$set('filter', 'all')"
                    class="px-4 py-1.5 rounded-lg transition-all text-sm
                    {{ $filter === 'all' ? 'bg-primary text-white' : 'bg-primary/10 text-primary hover:bg-primary/20' }}">
                    <i class="fas fa-layer-group mr-1"></i> Semua
                </button>

                <button wire:click="$set('filter', 'active')"
                    class="px-4 py-1.5 rounded-lg transition-all text-sm
                    {{ $filter === 'active' ? 'bg-primary text-white' : 'bg-primary/10 text-primary hover:bg-primary/20' }}">
                    <i class="fas fa-check-circle mr-1"></i> Aktif
                </button>

                <button wire:click="$set('filter', 'inactive')"
                    class="px-4 py-1.5 rounded-lg transition-all text-sm
                    {{ $filter === 'inactive' ? 'bg-primary text-white' : 'bg-primary/10 text-primary hover:bg-primary/20' }}">
                    <i class="fas fa-ban mr-1"></i> Nonaktif
                </button>

                <button wire:click="$set('filter', 'draft')"
                    class="px-4 py-1.5 rounded-lg transition-all text-sm
                    {{ $filter === 'draft' ? 'bg-primary text-white' : 'bg-primary/10 text-primary hover:bg-primary/20' }}">
                    <i class="fas fa-pencil-alt mr-1"></i> Draf
                </button>

                <button wire:click="$set('filter', 'archived')"
                    class="px-4 py-1.5 rounded-lg transition-all text-sm
                    {{ $filter === 'archived' ? 'bg-primary text-white' : 'bg-primary/10 text-primary hover:bg-primary/20' }}">
                    <i class="fas fa-archive mr-1"></i> Arsip
                </button>
            </div>



            {{-- Search --}}
            <div class="flex gap-2 items-center w-full md:w-auto">
                <input type="text" wire:model.defer="searchInput" placeholder="Cari bundling..."
                    class="flex-1 px-4 py-1.5 border rounded-lg text-sm dark:bg-dark dark:text-white border-gray-300 dark:border-gray-600 w-full md:w-64">
                <button wire:click="searchBundles"
                    class="px-4 py-1.5 bg-primary text-white rounded-lg text-sm hover:bg-primary/90">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
            </div>
        </div>

        {{-- Tombol Tambah --}}
        <div class="flex justify-start lg:justify-end">
            <button wire:click="toggleModal"
                class="px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-primary/90 whitespace-nowrap">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Bundling
            </button>
        </div>
    </div>


    {{-- Mode Hapus --}}
    @if ($deleteMode)
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <span class="text-sm text-gray-600 dark:text-gray-300 italic flex items-center gap-1">
                <i class="fas fa-check-double text-primary"></i> Pilih bundling yang ingin dihapus
            </span>
            <div class="flex flex-wrap gap-2">
                @if (count($selectedBundles) > 0)
                    <button wire:click="confirmDelete"
                        class="bg-red-600 text-white px-4 py-1.5 rounded-lg hover:bg-red-700 transition text-sm">
                        <i class="fas fa-trash mr-1"></i> Hapus Terpilih ({{ count($selectedBundles) }})
                    </button>
                @endif
                <button wire:click="cancelDelete"
                    class="bg-gray-300 text-gray-800 px-4 py-1.5 rounded-lg hover:bg-gray-400 transition text-sm">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
            </div>
        </div>
    @else
        <div class="text-right">
            <button wire:click="enableDeleteMode"
                class="bg-red-700 text-white px-4 py-1.5 rounded-lg hover:bg-red-800 transition text-sm">
                <i class="fas fa-trash-alt mr-1"></i> Hapus Bundling
            </button>
        </div>
    @endif

    {{-- Daftar Bundling --}}
    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mt-6 pt-5 border-t border-gray-300 dark:border-white/30">

        @forelse ($bundles as $bundle)
            <div class="glass p-4 rounded-xl shadow-lg flex flex-col gap-3 transition-all duration-200 relative
            {{ $deleteMode ? 'cursor-pointer hover:scale-[1.02]' : '' }}
            {{ in_array($bundle->id, $selectedBundles) ? 'ring-4 ring-primary' : 'ring-0' }}"
                @if ($deleteMode) wire:click="toggleSelect({{ $bundle->id }})" @endif>

                <div class="absolute top-3 right-3 text-xs text-right space-y-1 z-10">
                    <div class="bg-white/80 dark:bg-dark/80 px-2 py-1 rounded-md shadow">
                        <i class="fas fa-store text-primary mr-1"></i>{{ $bundle->creator->name ?? '-' }}
                    </div>
                    <div class="bg-white/80 dark:bg-dark/80 px-2 py-1 rounded-md shadow">
                        <i class="fas fa-info-circle mr-1 text-primary"></i>
                        <span class="{{ $bundle->status === 'active' ? 'text-green-600' : 'text-red-500' }}">
                            {{ ucfirst($bundle->status) }}
                        </span>
                    </div>
                </div>

                <div class="relative group">
                    <img src="{{ asset('storage/' . $bundle->thumbnail) }}"
                        class="h-32 w-full object-cover rounded-lg border border-gray-200 dark:border-gray-700 transition
                    {{ $deleteMode ? 'opacity-80' : '' }}">

                    @if (in_array($bundle->id, $selectedBundles))
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-white/70 dark:bg-dark/70 px-3 py-1 rounded-full text-sm font-semibold text-primary shadow">
                                <i class="fas fa-check-circle mr-1"></i> Terpilih
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-1 text-left">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-white truncate">
                        {{ $bundle->title }}
                    </h3>
                    <span class="text-primary font-bold text-sm">Rp
                        {{ number_format($bundle->price, 0, ',', '.') }}</span>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                    {{ $bundle->description }}
                </p>

                @unless ($deleteMode)
                    <button wire:click="showDetail({{ $bundle->id }})"
                        class="mt-2 px-3 py-1.5 rounded-md bg-primary text-white text-sm hover:bg-primary/90 transition">
                        <i class="fas fa-eye mr-1"></i> Lihat Detail
                    </button>
                @endunless
            </div>
        @empty
            <div
                class="col-span-full flex flex-col items-center justify-center py-20 text-center text-gray-500 dark:text-gray-300">
                <i class="fas fa-box-open text-5xl mb-4 text-gray-400"></i>
                <h3 class="text-xl font-semibold mb-2">Belum ada bundling</h3>
                <p class="text-sm">Tambahkan bundling kolaborasi untuk ditampilkan di sini</p>
            </div>
        @endforelse
    </div>



    {{-- Modal Tambah --}}
    @if ($showCreateModal)
        <div x-data="{ showModal: true }" x-show="showModal" @bundle-created.window="showModal = false" x-transition
            class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center overflow-auto">
            <div @click.outside="showModal = false"
                class="bg-white dark:bg-dark p-6 rounded-xl shadow-xl w-full max-w-6xl mx-auto relative max-h-[90vh] overflow-y-auto">
                <button wire:click="toggleModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                    <i class="fas fa-times-circle"></i>
                </button>

                <livewire:collaboration.bundle.create :collaboration-id="$collaborationId" />
            </div>
        </div>
    @endif

    {{-- Modal Detail --}}
    @if ($showDetailModal && $selectedBundleId)
        <div class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center">
            <div class="bg-white dark:bg-dark p-6 rounded-xl w-full max-w-4xl shadow-xl relative">
                <button wire:click="hideDetail" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                    <i class="fas fa-times-circle"></i>
                </button>
                <h2 class="text-lg font-bold mb-4 text-primary">
                    <i class="fas fa-info-circle mr-2"></i> Detail Bundling Kolaborasi
                </h2>
                @livewire('collaboration.bundle.detail', ['bundleId' => $selectedBundleId], key('bundle-detail-' . $selectedBundleId))
            </div>
        </div>
    @endif

</div>
