<nav id="navbar" class="fixed top-4 inset-x-0 z-50 mx-auto max-w-5xl px-4 lg:px-0 transition-all duration-500">
    <div id="navbar-pill"
        class="flex items-center justify-between rounded-full bg-white/70 backdrop-blur-xl px-4 py-2.5 shadow-sm border border-white/50 transition-all duration-500">
        <a href="#beranda" class="flex items-center gap-3 shrink-0">
            @if ($profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" class="h-9 w-9 rounded-full object-cover shadow-sm"
                    alt="Logo">
            @else
                <div
                    class="h-9 w-9 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                    DS</div>
            @endif
            <span
                class="text-base font-extrabold tracking-tight text-slate-900 hidden sm:block">{{ $profil->nama_usaha }}</span>
        </a>
        <div class="hidden lg:flex items-center p-1 bg-slate-50/50 rounded-full border border-slate-100/50">
            <a href="#beranda"
                class="px-5 py-1.5 text-sm font-medium text-slate-600 rounded-full hover:bg-white hover:text-blue-600 hover:shadow-sm transition-all duration-300">Beranda</a>
            <a href="#tentang"
                class="px-5 py-1.5 text-sm font-medium text-slate-600 rounded-full hover:bg-white hover:text-blue-600 hover:shadow-sm transition-all duration-300">Tentang</a>
            <a href="#layanan"
                class="px-5 py-1.5 text-sm font-medium text-slate-600 rounded-full hover:bg-white hover:text-blue-600 hover:shadow-sm transition-all duration-300">Layanan</a>
            <a href="#kontak"
                class="px-5 py-1.5 text-sm font-medium text-slate-600 rounded-full hover:bg-white hover:text-blue-600 hover:shadow-sm transition-all duration-300">Kontak</a>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('login') }}"
                class="hidden lg:inline-flex px-6 py-2 text-sm font-semibold text-white bg-slate-900 rounded-full hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">Login
                Admin</a>
            <button data-collapse-toggle="navbar-menu" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-slate-600 rounded-full lg:hidden hover:bg-white hover:shadow-sm focus:outline-none transition-all"
                aria-controls="navbar-menu" aria-expanded="false">
                <span class="sr-only">Buka menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
    </div>
    <div id="navbar-menu"
        class="hidden mt-3 mx-auto max-w-5xl overflow-hidden rounded-2xl bg-white/90 backdrop-blur-xl border border-white/50 shadow-xl lg:hidden">
        <ul class="flex flex-col p-5 font-medium space-y-2">
            <li><a href="#beranda"
                    class="block py-2.5 px-4 text-slate-900 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-colors">Beranda</a>
            </li>
            <li><a href="#tentang"
                    class="block py-2.5 px-4 text-slate-900 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-colors">Tentang</a>
            </li>
            <li><a href="#layanan"
                    class="block py-2.5 px-4 text-slate-900 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-colors">Layanan</a>
            </li>
            <li><a href="#kontak"
                    class="block py-2.5 px-4 text-slate-900 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-colors">Kontak</a>
            </li>
            <li><a href="{{ route('login') }}"
                    class="block py-3 px-4 text-white bg-slate-900 rounded-xl text-center mt-4 font-semibold hover:bg-blue-600 transition-colors">Login
                    Admin</a></li>
        </ul>
    </div>
</nav>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        const pill = document.getElementById('navbar-pill');
        if (window.scrollY > 50) {
            navbar.classList.add('top-2');
            navbar.classList.remove('top-4');
            pill.classList.add('shadow-md', 'bg-white/90');
            pill.classList.remove('shadow-sm', 'bg-white/70');
        } else {
            navbar.classList.add('top-4');
            navbar.classList.remove('top-2');
            pill.classList.add('shadow-sm', 'bg-white/70');
            pill.classList.remove('shadow-md', 'bg-white/90');
        }
    });
</script>
