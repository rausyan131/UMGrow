<div class="space-y-6">

    {{-- Tab Navigation --}}
    <div class="flex gap-3 border-b border-gray-200 dark:border-gray-700">



        <button @if ($tab !== 'collaboration-product') wire:click="setTab('collaboration-product')" @endif
            wire:click="setTab('collaboration-product')"
            @if ($tab == 'collaboration-product') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
                    @else
                        class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Produk Kolaborasi

        </button>

        <button wire:click="setTab('bundling')"
            @if ($tab == 'bundling') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
                @else
                class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Bundling Paket
        </button>

        <button wire:click="setTab('task')"
            @if ($tab == 'task') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
            @else
            class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Tugas
        </button>

        <button wire:click="setTab('bundle-sales-record')"
            @if ($tab == 'bundle-sales-record') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
                @else
                class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Catatan Penjualan
        </button>
        <button wire:click="setTab('insight')"
            @if ($tab == 'insight') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
        @else
        class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            insight
        </button>
        <button wire:click="setTab('info')"
            @if ($tab == 'history') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
            @else
            class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            info
        </button>
    </div>


    {{-- Tab Content --}}
    <div class="w-[90%] mx-auto mt-10">
        @if ($tab === 'task')
            <livewire:collaboration.task-list :collaboration-id="$collaboration->id" />
        @elseif ($tab === 'collaboration-product')
            <livewire:collaboration.bundle.main :collaboration-id="$collaboration->id" />
        @elseif ($tab === 'bundling')
            <livewire:collaboration.bundle.bundle-list :collaboration-id="$collaboration->id" />
        @elseif ($tab === 'bundle-sales-record')
            <livewire:collaboration.bundle-sales.sales-record :collaboration-id="$collaboration->id" />
        @elseif ($tab === 'insight')
            {{-- <livewire:collaboration.bundle-sales.insight :collaboration-id="$collaboration->id" /> --}}
                <div class=" p-6 text-center text-gray-400 italic w-full flex justify-center items-center">
                    <div>
                    <i class="fas fa-history text-6xl mb-2 text-primary"></i><br>
                    <p class="text-2xl">Coming Soon</p>
                </div>
                </div>
     
    </div>


</div>
