<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umgrow | {{ $title }}</title>

    <script>
        if (
            localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @livewireStyles
    {{-- Fonts  --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Font Aweomse --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    {{-- Swiper CSS  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    {{-- alpine js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Styles / Scripts  --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-roboto bg-background-secondary dark:bg-dark w-full overflow-x-hidden">
    <div class="h-screen box-border  flex text-text dark:text-text-dark relative scroll-smooth overflow-hidden ">

        {{-- Pesan Sukses --}}
        <div x-data="{ show: false, message: '', type: 'success' }"
            x-on:show-toast.window="
        message = $event.detail.message;
        type = $event.detail.type || 'success';
        show = true;
        setTimeout(() => show = false, 3000);
    "
            x-show="show" x-transition
            class="fixed top-8 right-8 z-50 w-80 px-6 py-4 rounded-lg shadow-lg border pointer-events-auto"
            :class="{
                'bg-white text-green-700 border-green-300 dark:bg-dark dark:text-green-300 dark:border-green-600': type === 'success',
                'bg-white text-red-700 border-red-300 dark:bg-dark dark:text-red-300 dark:border-red-600': type === 'error'
            }">
            <div class="flex justify-between items-start gap-4">
                <div>
                    <p class="font-semibold text-base" x-text="type === 'success' ? 'Berhasil!' : 'Gagal!'"></p>
                    <p class="text-sm mt-1" x-text="message"></p>
                </div>
                <button @click="show = false"
                    class="font-bold text-lg leading-none hover:text-red-500 transition">&times;</button>
            </div>
        </div>



        {{-- side bar --}}
        <x-partials.sidebar />
        <!-- Mini Sidebar untuk Mobile -->
        <aside id="mobileSidebar"
            class="fixed top-0 left-0 z-50 w-20 h-full bg-white dark:bg-dark shadow-lg border-r border-gray-200 dark:border-white/10 transform -translate-x-full transition-transform duration-300 md:hidden flex flex-col items-center py-4 gap-6">

            <a href="{{ route('dashboard') }}">
                <i class="fas fa-chart-line text-xl text-primary"></i>
            </a>

            <a href="{{ route('collaboration') }}">
                <i class="fas fa-handshake text-xl text-primary"></i>
            </a>

            <a href="{{ route('umkm.products') }}">
                <i class="fas fa-box text-xl text-primary"></i>
            </a>

            <a href="{{ route('profile.detail-umkm') }}">
                <i class="fas fa-user-circle text-xl text-primary"></i>
            </a>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col w-full">
            {{-- top bar --}}
            <x-partials.topbar />
            <main class="md:ml-10 flex-1 overflow-y-auto mt-5 overflow-hidden ">

                {{ $slot }}

            </main>
        </div>
    </div>



    @livewireScripts
    {{-- Swiper JS  --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @vite(['resources/js/theme.js'])

    {{ $scripts ?? '' }}
</body>

</html>
