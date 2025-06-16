@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::check() ? Auth::user()->umkm : null;
@endphp

<header
    class="glass flex rounded-tr-none items-center justify-between p-4 md:ml-10 border-t-transparent border-r-transparent">

    <!-- Hamburger Menu (Mobile Only) -->
    <div class="flex gap-6 items-center">
        <button id="openSidebarBtn" class="md:hidden fixed top-4 left-4 z-50 p-2 bg-orange-600 text-white rounded shadow">
            <i class="fas fa-bars"></i>
        </button>


        <h1 class="text-xl font-semibold text-orange-600"></h1>
    </div>
    <!-- Menu Profil -->
    <div class="relative">
        <button id="profileBtn"
            class="w-10 h-10 rounded-full overflow-hidden border-2 border-orange-500 focus:outline-none">
            <img src="{{ $user && $user->image ? asset('storage/umkm/profile/' . $user->image) : asset('images/profile.png') }}"
                class="w-full h-full object-cover">
        </button>

        <div id="profileMenu" class="hidden glass absolute right-0 mt-2 w-56 p-4 text-sm bg-gray-100 dark:bg-dark z-50">
            <a href="#" class="block button">
                <i class="fas fa-cog mr-2"></i> Settings
            </a>
            <button id="toggleThemeBtn" class="w-full flex items-center text-left button">
                <i id="themeIcon" class="fas mr-2"></i>
                <span id="themeLabel">Toggle Theme</span>
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left button">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>
