const initUI = () => {
    // --- THEME ---
    const applyTheme = () => {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const themeIcon = document.getElementById("themeIcon");
        const themeLabel = document.getElementById("themeLabel");

        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
            themeIcon && (themeIcon.className = 'fas fa-sun mr-2');
            themeLabel && (themeLabel.textContent = 'Light Mode');
        } else {
            document.documentElement.classList.remove('dark');
            themeIcon && (themeIcon.className = 'fas fa-moon mr-2');
            themeLabel && (themeLabel.textContent = 'Dark Mode');
        }
    };

    applyTheme();

    // Remove existing event listeners by cloning (anti-double)
    const cloneAndReplace = (el) => {
        if (!el) return null;
        const newEl = el.cloneNode(true);
        el.parentNode.replaceChild(newEl, el);
        return newEl;
    };

    const toggleThemeBtn = cloneAndReplace(document.getElementById("toggleThemeBtn"));
    toggleThemeBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        localStorage.setItem('theme', current === 'dark' ? 'light' : 'dark');
        applyTheme();
    });

    // --- SIDEBAR ---
    const sidebar = document.getElementById("sidebar");
    const collapseBtn = cloneAndReplace(document.getElementById("collapseSidebarBtn"));
    const collapseIcon = document.getElementById("collapseIcon");
    const hamburgerBtn = cloneAndReplace(document.getElementById("openSidebarBtn"));

    collapseBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("w-74");
        sidebar.classList.toggle("w-24");
        sidebar.querySelectorAll(".sidebar-text").forEach(el => el.classList.toggle("hidden"));
        const logo = sidebar.querySelector(".sidebar-logo");
        if (logo) logo.classList.toggle("hidden");
        collapseIcon?.classList.toggle("fa-angle-left");
        collapseIcon?.classList.toggle("fa-angle-right");
    });

    hamburgerBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("translate-x-full");
        hamburgerBtn.classList.toggle("hidden", !sidebar.classList.contains("translate-x-full"));
    });

    // --- PROFILE DROPDOWN ---
    const profileBtn = cloneAndReplace(document.getElementById("profileBtn"));
    const profileMenu = document.getElementById("profileMenu");

    profileBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        profileMenu?.classList.toggle("hidden");
    });

    // --- GLOBAL CLICK ---
    document.addEventListener("click", (e) => {
        if (
            sidebar && !sidebar.contains(e.target) &&
            hamburgerBtn && !hamburgerBtn.contains(e.target) &&
            window.innerWidth < 768
        ) {
            sidebar.classList.add("-translate-x-full");
            hamburgerBtn.classList.remove("hidden");
        }

        if (
            profileMenu && !profileMenu.contains(e.target) &&
            profileBtn && !profileBtn.contains(e.target)
        ) {
            profileMenu.classList.add("hidden");
        }
    });

    // --- RESIZE ---
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            sidebar?.classList.remove("-translate-x-full");
            hamburgerBtn?.classList.remove("hidden");
        } else {
            sidebar?.classList.add("-translate-x-full");
        }
    });
};

// --- PANGGIL DI AWAL DAN SETELAH SPA NAVIGASI ---
document.addEventListener("DOMContentLoaded", initUI);
document.addEventListener("livewire:navigated", initUI);
