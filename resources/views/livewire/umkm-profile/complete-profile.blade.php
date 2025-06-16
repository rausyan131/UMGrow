<div class="w-full h-screen flex justify-center items-center bg-black">
    <div id="formContainer"
        class="w-full max-w-5xl mx-auto p-12 rounded-bl-3xl rounded-tr-3xl backdrop-blur-xl bg-white/10 shadow-2xl border border-white/20 transition-all duration-300">
        <div class="flex flex-col md:flex-row items-start gap-16" id="contentWrapper">
            <div class="w-full md:w-2/3 space-y-6 text-white">

                @if ($step === 1)
                    <div class="w-full max-w-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            @foreach ($categories as $category)
                                @php
                                    $isSelected = in_array($category->id, $selectedCategories);
                                    $disableClick = !$isSelected && count($selectedCategories) >= 3;
                                @endphp
                                <div wire:click="{{ $disableClick ? '' : "toggleCategory({$category->id})" }}"
                                    class="cursor-pointer p-4 rounded-bl-xl rounded-tr-xl border border-white/20 text-center select-none 
                                    {{ $isSelected
                                        ? 'bg-primary/10 text-primary bg-opacity-30 shadow-lg ring-2 ring-primary ring-opacity-60'
                                        : ($disableClick
                                            ? 'opacity-50 cursor-not-allowed'
                                            : 'hover:bg-primary/10 hover:text-primary hover:bg-opacity-20 transition duration-300 ease-in-out') }}"
                                    @if ($disableClick) title="Maksimal pilih 3 kategori" @endif>
                                    {{ $category->category_name }}
                                </div>
                            @endforeach
                        </div>

                    </div>
                @elseif ($step === 2)
                    <div class="space-y-6">
                        <div>
                            <input type="text" id="umkm_name" wire:model.debounce.500ms="umkm_name"
                                class="w-full bg-white/20 border border-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50"
                                placeholder="Masukkan nama UMKM" required />
                            @error('umkm_name')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
            </div>

            <div class="w-full md:w-1/3 space-y-6 text-white">
                <h1 class="text-4xl font-bold">Selamat Datang di <span class="text-primary">UMGrow</span></h1>
                @if ($step === 1)
                    <p>Silakan pilih kategori untuk bisnis Anda, maksimal 3 kategori</p>
                @elseif ($step === 2)
                    <p>Lengkapi data UMKM Anda</p>
                @endif

                <div class="flex justify-between gap-2 mt-6">
                    <button wire:click="prevStep"
                        class="w-full rounded-xl disabled:opacity-30 px-4 py-2 bg-white/20 hover:bg-white/30 transition"
                        @if ($step == 1) disabled @endif>
                        ← Sebelumnya
                    </button>
                    @if ($step < $totalStep)
                        <button wire:click="nextStep"
                            class="w-full px-4 py-2 bg-white/20 hover:bg-white/30 transition rounded-xl">
                            Selanjutnya →
                        </button>
                    @else
                        <button wire:click="save" onclick="console.log('Tombol Simpan diklik')"
                            class="w-full px-4 py-2 bg-primary hover:bg-primary/80 transition rounded-xl font-semibold">
                            Simpan ✓
                        </button>
                    @endif
                </div>


                @if ($step === 1)
                    <div>
                        <h2 class="text-xl font-semibold mb-3">Kategori Terpilih:</h2>
                        @if (count($selectedCategories) > 0)
                            <ul class="flex gap-4 flex-wrap">
                                @foreach ($categories->whereIn('id', $selectedCategories) as $selected)
                                    <li
                                        class="bg-primary/20 text-primary shadow-2xs bg-opacity-40 px-4 py-1  rounded-bl-xl rounded-tr-xl">
                                        {{ $selected->category_name }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-white/70 italic">Belum ada kategori yang dipilih.</p>
                        @endif
                        @error('selectedCategories')
                            <span class="text-red-500 mt-4">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                @if ($errorMessage)
                    <div class="text-red-500 text-center mt-4">
                        {{ $errorMessage }}
                    </div>
                @endif
            </div>


        </div>

        <div id="progressBarContainer" class="w-full mt-8">
            <div class="w-full bg-white/20 rounded-full h-3 overflow-hidden">
                <div class="bg-gradient-to-r from-[#FF7A00] to-[#FFA94D] h-full rounded-full transition-all duration-300"
                    style="width: {{ ($step / $totalStep) * 100 }}%"></div>
            </div>
            <div class="text-center text-sm mt-2 text-white/70">Halaman {{ $step }} / {{ $totalStep }}
            </div>
        </div>

        <div wire:loading wire:target="save" class="text-white text-center mt-4">Menyimpan...</div>



    </div>
</div>
