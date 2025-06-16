<nav class="flex items-center justify-between p-6 text-white relative">
    <div class="text-xl font-bold">UMGrow</div>

    <button id="menu-btn" class="block lg:hidden focus:outline-none">
        <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div
        id="menu"
        class="hidden lg:flex lg:items-center lg:space-x-10 w-full lg:w-auto absolute lg:static top-full left-0 bg-black lg:bg-transparent p-6 lg:p-0 shadow-lg lg:shadow-none z-10">
        <ul class="flex flex-col lg:flex-row lg:space-x-10 space-y-4 lg:space-y-0 text-lg font-semibold tracking-wide">
            <li>
                <a href="#home" class="flex items-center gap-2 group relative transition duration-300 hover:text-primary">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="#about" class="flex items-center gap-2 group relative transition duration-300 hover:text-primary">
                    <i class="fas fa-info-circle"></i>
                    <span>About Us</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-2 group relative transition duration-300 hover:text-primary">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </li>
            <li>
                <a href="{{route('login')}}" class="flex items-center gap-2 group relative transition duration-300 px-4 bg-white text-black hover:border hover:border-white hover:bg-black hover:text-white rounded-2xl">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Log In</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
