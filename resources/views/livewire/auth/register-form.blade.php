<div class="w-full h-screen flex items-center justify-center gap-10 flex-col relative">


    <div
        class="absolute w-96 h-96 bg-primary rounded-full top-[-100px] left-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow">
    </div>

    <div
        class="absolute w-52 h-62 md:w-62 md:h-96 bg-primary rounded-full bottom-[-100px] right-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow">
    </div>

    <div class="backdrop-blur-xl bg-white/10 border border-white/30 rounded-2xl p-8 w-[90%] max-w-md shadow-2xl">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Daftar Akun Baru</h1>

        <form wire:submit.prevent="register" class="flex flex-col space-y-4">

            <div>
                <input type="text" wire:model="name" placeholder="Nama lengkap"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50" />
                @error('name')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>


            <div>
                <input type="email" wire:model="email" placeholder="Email"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50" />

                @error('email')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="password" wire:model="password" placeholder="Password"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50"/>
                @error('password')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="password" wire:model="password_confirmation" placeholder="Konfirmasi Password"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50" />
                @error('password_confirmation')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="mt-5 bg-white/20 text-white px-4 py-2 rounded-md hover:bg-white/30 transition backdrop-blur-md border border-white/40 disabled:opacity-40 disabled:cursor-not-allowed">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-4 text-center text-white/80">
            Sudah punya akun? <a wire:navigate href="{{ route('login') }}"
                class="text-white underline hover:text-white/90">Masuk di sini!</a>
        </div>
    </div>
</div>
