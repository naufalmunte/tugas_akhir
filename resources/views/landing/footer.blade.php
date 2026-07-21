<footer id="kontak" class="bg-[#1f2937] text-white pt-10 pb-6 antialiased">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <div>
                <h2 class="text-xl font-bold mb-4 text-[#5AA8D6]">{{ $profil->nama_usaha }}</h2>
                <p class="text-gray-400 leading-relaxed text-sm">
                    Sistem Informasi Manajemen Layanan Door Smeer Mobil. Kami berkomitmen memberikan pelayanan terbaik,
                    cepat, dan bersih untuk kendaraan Anda.
                </p>
            </div>
            <div>
                <h3 class="text-base font-bold mb-4 uppercase tracking-wider text-gray-100">Hubungi Kami</h3>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#5AA8D6] me-3 mt-0.5 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.488 4M12 3a8.997 8.997 0 0 0-7.488 4m14.976 0C19.263 5.485 16.89 4 14 4M4.512 7c.25-1.485 2.622-2.97 5.488-3" />
                        </svg>
                        <span>{{ $profil->alamat }}</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-[#5AA8D6] me-3 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a2.082 2.082 0 0 1-2.82.203 8.36 8.36 0 0 1-3.436-3.436 2.082 2.082 0 0 1 .203-2.82l.613-.613a1.733 1.733 0 0 0 0-2.45L7.471 3.812C6.794 3.135 5.609 3.2 5.011 3.968A5.006 5.006 0 0 0 4 7c0 5.523 4.477 10 10 10a5.006 5.006 0 0 0 3.032-1.011c.768-.598.833-1.783.156-2.46Z" />
                        </svg>
                        <span>{{ $profil->no_hp }}</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-[#5AA8D6] me-3 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8m-18 0l8 5.6a1 1 0 0 0 1.2 0L21 8M3 8a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2" />
                        </svg>
                        <span>{{ $profil->email }}</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#5AA8D6] me-3 mt-0.5 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>{{ $profil->jam_operasional }}</span>
                    </li>
                </ul>
            </div>
            <div class="h-48 rounded-2xl overflow-hidden border border-gray-700 shadow-md bg-gray-800">
                <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                    {!! $profil->maps_embed !!}
                </div>
            </div>
        </div>
        <div class="pt-6 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-400 text-center md:text-left">
                © {{ date('Y') }} <span class="font-semibold text-gray-200">{{ $profil->nama_usaha }}</span>. All
                Rights Reserved.
            </p>
        </div>
    </div>
</footer>
