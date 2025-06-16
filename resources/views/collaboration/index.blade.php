<div class="space-y-6">

    {{-- Tab Navigation --}}
    <div class="flex gap-3 border-b border-gray-200 dark:border-gray-700">
        
        <button
        @if ($tab !== 'active')
         wire:click="setTab('active')"
         @endif
         
        @if ($tab == 'active')
             class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
        @else
        class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Kolaborasi Aktif
        </button>

        <button wire:click="setTab('sent')"
            @if ($tab == 'sent')
                class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
            @else
                class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
                Ajuan Kolaborasi
            
        </button>

        <button wire:click="setTab('received')"
            @if ($tab == 'received') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
        @else
        class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Permintaan Kolaborasi
        </button>

        <button wire:click="setTab('history')"
            @if ($tab == 'history') class="tab-button px-4 py-2 text-sm font-semibold border-b-2 transition text-primary border-primary"
        @else
        class=" px-4 py-2 text-sm font-semibold transition text-text dark:text-white/40 " @endif>
            Riwayat Kolaborasi
        </button>
    </div>


    {{-- Tab Content --}}
    <div class="mt-4 space-y-4">
        @if ($tab === 'active')
            <livewire:collaboration.active />
        @elseif ($tab === 'sent')
            <livewire:collaboration.sent-request />
        @elseif ($tab === 'received')
            <livewire:collaboration.received-request />
        @elseif ($tab === 'history')
            <div class=" p-6 text-center text-gray-400 italic w-full flex justify-center items-center">
                <div>
                <i class="fas fa-history text-6xl mb-2 text-primary"></i><br>
                <p class="text-2xl">Coming Soon</p>
            </div>
            </div>
        @endif
    </div>


</div>
