<aside id="sidebar"
    class="p-5  glass fixed md:relative z-40  w-74 -translate-x-full md:translate-x-0
    transition-all duration-300 ease-in-out flex flex-col items-stretch overflow-y-auto justify-between border-l-transparent">

    <!-- Logo dan Collapse -->
    <div>
        <div class="flex items-center justify-between mb-4 bg-primary/15 px-2 rounded-bl-xl rounded-tr-xl">
            <h2 class="sidebar-logo text-2xl font-bold text-primary">UMGrow</h2>
            <button id="collapseSidebarBtn"
                class=" md:inline-flex items-center justify-center w-10 h-10 text-white 
                bg-primary hover:text-white transition-all duration-300 ease-in-out rounded-full 
                shadow-md transform hover:rotate-180">
                <i id="collapseIcon" class="fas fa-angle-left transition-transform duration-300"></i>
            </button>
        </div>

        

        <div class="border-b dark:border-white/20  border-gray-400  mb-4"></div>

        <!-- Navigasi -->
        <nav class="space-y-4 flex flex-col items-start md:items-stretch mt-5">

            <!-- === Section 1: Dashboard === -->
            <a href="{{ route('dashboard') }}"
                class="button sidebar-item flex items-center gap-3 w-full {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : '' }}">
                <i class="fas fa-chart-line text-lg"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <div class="border-t dark:border-white/20  border-gray-400  my-2"></div>

            <!-- === Section 2: Kolaborasi === -->
            <a href="{{ route('collaboration') }}"
                class="button sidebar-item flex items-center gap-3 w-full {{ request()->routeIs('collaboration') ? 'bg-primary text-white' : '' }}">
                <i class="fas fa-handshake text-lg"></i>
                <span class="sidebar-text">Kolaborasi</span>
            </a>

            <a href="{{ route('umkm.umkm-list') }}"
                class="button sidebar-item flex items-center gap-3 w-full {{ request()->routeIs('umkm.umkm.list') ? 'bg-primary text-white' : '' }}">
                <i class="fas fa-search text-lg"></i>
                <span class="sidebar-text">Cari Partner</span>
            </a>


            <div class="border-t dark:border-white/20  border-gray-400 my-2 pb-2"></div>

            <!-- === Section 3: Produk & Penjualan === -->
            <a href="{{ route('umkm.products') }}"
                class="button sidebar-item flex items-center gap-3 w-full {{ request()->routeIs('umkm.products') ? 'bg-primary text-white' : '' }}">
                <i class="fas fa-box text-lg"></i>
                <span class="sidebar-text">Produk Saya</span>
            </a>




            <div class="border-t dark:border-white/20  border-gray-400 my-2"></div>

        </nav>
    </div>

    <!-- Profil -->
    <div class="mt-6 border-t dark:border-white/20  border-gray-400 my-2 pt-4">
        <a href="{{ route('profile.detail-umkm') }}"
            class="button sidebar-item flex items-center gap-3 w-full {{ request()->routeIs('profile.detail-umkm') ? 'bg-primary text-white' : '' }}">
            <i class="fas fa-user-circle text-lg"></i>
            <span class="sidebar-text">Profil Saya</span>
        </a>
    </div>
</aside>
