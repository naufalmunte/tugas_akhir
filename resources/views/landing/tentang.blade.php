<section id="tentang" class="py-18 bg-white text-slate-900 antialiased">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="flex flex-col items-start text-left">
                <span
                    class="text-[#5AA8D6] font-semibold tracking-wider uppercase text-sm bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100 mb-6">Tentang
                    Kami</span>
                <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 mb-6">
                    {{ $profil->nama_usaha }}</h2>
                <p class="text-slate-600 leading-relaxed text-lg font-light">{{ $profil->deskripsi }}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div
                    class="bg-gray-50 rounded-3xl p-6 border border-gray-100 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-car text-2xl text-[#5AA8D6]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Cuci Mobil</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Pelayanan cuci mobil cepat dan bersih.</p>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-6 border border-gray-100 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-motorcycle text-2xl text-[#5AA8D6]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Cuci Motor</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Motor bersih dengan perawatan maksimal.</p>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-6 border border-gray-100 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-rug text-2xl text-[#5AA8D6]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Cuci Karpet</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Membersihkan karpet hingga higienis.</p>
                </div>
                <div
                    class="bg-gradient-to-br from-[#5AA8D6] to-blue-500 rounded-3xl p-6 text-white hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/30 transition-all duration-300 group">
                    <div
                        class="w-14 h-14 bg-white/20 rounded-2xl backdrop-blur-sm flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-star text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pelayanan Terbaik</h3>
                    <p class="text-blue-50 text-sm leading-relaxed">Kepuasan pelanggan adalah prioritas utama kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>
