<section id="layanan" class="py-18 bg-gray-50 text-slate-900">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="flex flex-col items-center text-center gap-3 mb-12">
            <span
                class="text-[#5AA8D6] font-semibold tracking-wider uppercase text-xs bg-blue-50 px-3 py-1 rounded-full border border-blue-100">Katalog
                Layanan</span>
            <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900">Pilih paket sesuai kebutuhan
                Anda.</h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($kategoriLayanan as $kategori)
                <div
                    class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-xl font-bold mb-5 text-slate-900 flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-[#5AA8D6] rounded-full"></span>
                        {{ $kategori->nama_kategori }}
                    </h3>
                    <ul class="space-y-1">
                        @foreach ($kategori->layanan as $layanan)
                            <li
                                class="flex justify-between items-center py-2.5 border-b border-gray-50 last:border-0 group">
                                <span
                                    class="text-slate-500 group-hover:text-slate-900 transition-colors text-sm font-medium">{{ $layanan->nama_layanan }}</span>
                                <span
                                    class="font-semibold text-slate-600 bg-gray-50 border border-gray-100 px-3 py-1 rounded-full text-xs group-hover:border-[#5AA8D6] group-hover:text-[#5AA8D6] transition-colors">Rp
                                    {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
