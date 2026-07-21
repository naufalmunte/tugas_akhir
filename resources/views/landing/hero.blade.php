<section id="beranda" class="relative pt-18 pb-12 lg:pt-10 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 lg:px-6 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 shadow-sm mb-8 hover:shadow-md transition-shadow">
                <span class="flex h-2.5 w-2.5 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Sistem Informasi Door
                    Smeer</span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-8 leading-[1.1]">
                {{ $profil->nama_usaha }} <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Cepat, Bersih,
                    Premium.</span>
            </h1>
            <p class="text-lg lg:text-xl text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto font-light">
                {{ $profil->deskripsi }}
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#kontak"
                    class="px-8 py-4 rounded-full bg-slate-900 text-white font-medium hover:bg-blue-600 hover:shadow-xl hover:shadow-blue-500/30 transition-all duration-300">
                    Hubungi Kami Sekarang
                </a>
                <a href="{{ route('login') }}"
                    class="px-8 py-4 rounded-full bg-white text-slate-900 font-medium border border-gray-200 hover:border-blue-200 hover:bg-blue-50 transition-all duration-300">
                    Login Admin
                </a>
            </div>
        </div>
    </div>
</section>
