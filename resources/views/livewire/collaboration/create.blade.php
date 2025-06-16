<div class="space-y-6" x-data="{
    addTo(field, text) {
        const el = document.getElementById(field)
        let current = el.value.trim()
        if (current && !current.endsWith('.')) current += '.'
        el.value = (current ? current + ' ' : '') + text
        el.dispatchEvent(new Event('input'))
    }
}">
    <h2 class="text-xl font-bold text-text dark:text-white">Ajukan Kolaborasi</h2>

    {{-- Pesan --}}
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Apa yang ingin anda sampaikan
            ?</label>

        <div class="flex flex-wrap gap-2 mb-2">
            <span @click="addTo('messageInput', 'Saya tertarik dengan produk Anda')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Saya tertarik dengan produk Anda
            </span>
            <span @click="addTo('messageInput', 'Ayo kolaborasi untuk promo bersama')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Ayo kolaborasi untuk promo bersama
            </span>
            <span @click="addTo('messageInput', 'Kita bisa buat bundling produk')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Kita bisa buat bundling produk
            </span>
        </div>

        <textarea id="messageInput" wire:model.defer="message" rows="4"
            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring focus:ring-primary"
            placeholder="Tulis pesan..."></textarea>
        @error('message')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ide Kolaborasi --}}
    <div>
        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Apa ide anda untuk kolaborasi
            ini?</label>

        {{-- Label Saran --}}
        <div class="flex flex-wrap gap-2 mb-2">
            <span @click="addTo('ideasInput', 'Bundle produk diskon')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Bundle produk diskon
            </span>
            <span @click="addTo('ideasInput', 'Event promosi gabungan')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Event promosi gabungan
            </span>
            <span @click="addTo('ideasInput', 'Kerja sama reseller')"
                class="cursor-pointer px-3 py-1 text-sm rounded-full bg-primary/10 text-primary hover:bg-primary hover:text-white transition">
                Kerja sama reseller
            </span>
        </div>

        <textarea id="ideasInput" wire:model.defer="ideas" rows="3"
            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring focus:ring-primary"
            placeholder="Tulis ide kolaborasi..."></textarea>
    </div>

    {{-- Cari Produk --}}
    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Produk apa yang ingin Anda libatkan?</label>

        <div class="flex flex-col sm:flex-row items-stretch gap-2">
            <input type="text" wire:model.defer="searchInput" placeholder="Cari nama produk..."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring focus:ring-primary transition">

            <button wire:click="searchProducts"
                class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/80 transition whitespace-nowrap">
                <i class="fas fa-search mr-1"></i> Cari
            </button>
        </div>
    </div>


    {{-- Produk Terpilih --}}
    @if (!empty($selectedProduct) && count($selectedProduct))
        <div class="flex flex-wrap gap-3">
            @foreach ($selectedProduct as $product)
                <div
                    class="flex items-center gap-2 px-3 py-2 rounded-full bg-primary/10 text-primary text-sm border border-primary/30">
                    <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                        class="w-6 h-6 object-cover rounded-full">
                    <span>{{ $product['name'] }}</span>
                    <button wire:click="removeProduct({{ $product['id'] }})"
                        class="ml-1 text-red-500 hover:text-red-700 text-xs font-bold">×</button>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Pilih Produk --}}
    @if ($searchKeyword)
        <div class="flex gap-4 overflow-x-auto pb-2 hide-scrollbar">
            @forelse ($products as $product)
                <label
                    class="min-w-[250px] bg-white dark:bg-dark p-4 rounded-xl shadow border border-primary/10 hover:border-primary transition cursor-pointer flex-shrink-0 flex flex-col gap-3">
                    <div
                        class="w-full h-32 bg-gray-100 dark:bg-dark rounded-md overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="object-contain h-full max-h-32" />
                    </div>
                    <div class="flex items-start gap-3">
                        <input type="checkbox" wire:model="selectedProducts" value="{{ $product->id }}"
                            class="appearance-none w-5 h-5 border-2 border-primary rounded-full checked:bg-primary checked:border-transparent transition" />
                        <div>
                            <h3 class="text-sm font-semibold text-text dark:text-white">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </label>
            @empty
                <p class="text-sm text-gray-400">Tidak ada produk ditemukan...</p>
            @endforelse
        </div>
        @error('selectedProducts')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    @endif


    <div class="flex justify-end">
        <button wire:click="submit" class="btn-primary">Ajukan Kolaborasi</button>
    </div>

    <div x-data x-on:refresh-page.window="location.reload()">
    </div>
</div>
