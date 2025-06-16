<div class="w-full h-screen flex items-center justify-center gap-10 flex-col  overflow-y-">

    <!-- Background -->
    <div
        class="absolute w-96 h-96 bg-primary rounded-full top-[-100px] left-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow">
    </div>

    <div
        class="absolute w-62 h-62 md:w-62 md:h-62 bg-primary rounded-full bottom-0 right-[-130px] blur-2xl -z-10 bg-gradient-to-b from-primary via-primary via-40% to-white/30 animate-float-glow">
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="bg-green-400/20 border border-green-300/30 text-green-100 px-4 py-3 rounded-xl text-center backdrop-blur-md w-[90%] max-w-md shadow-lg flex justify-between items-center"
            style="display: none;">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-green-100 hover:text-green-300 font-bold focus:outline-none ml-4"
                aria-label="Close notification">
                &times;
            </button>
        </div>
    @endif



    <div class="backdrop-blur-xl bg-white/10 border border-white/30 rounded-2xl p-8 w-[90%] max-w-md shadow-2xl">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Login</h1>

        <form class="flex flex-col space-y-4" wire:submit.prevent="login">

            <div>
                <input type="email" placeholder="Email" wire:model="email"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50" />
                @error('email')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="password" placeholder="Password" wire:model="password"
                    class="w-full bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-md outline-none focus:ring-2 focus:ring-white/50" />
                @error('password')
                    <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="mt-5 bg-white/20 text-white px-4 py-2 rounded-md hover:bg-white/30 transition backdrop-blur-md border border-white/40 disabled:opacity-50 disabled:cursor-not-allowed">
                Login
            </button>
        </form>

        <div class="mt-4 text-center text-white/80">
            Belum memiliki akun? <a wire:navigate href="{{ route('register') }}"
                class="text-white underline hover:text-white/90">Daftar sekarang!</a>
        </div>
        
    </div>
</div>
