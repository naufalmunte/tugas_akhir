<section id="kontak" class="py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-16">

            <div>

                <span class="text-[#5AA8D6] font-semibold uppercase">

                    Kontak

                </span>

                <h2 class="text-4xl font-bold mt-3 mb-10">

                    Hubungi Kami

                </h2>

                <div class="space-y-6">

                    <div>

                        <h4 class="font-semibold">Alamat</h4>

                        <p class="text-gray-600">
                            {{ $profil->alamat }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold">No HP</h4>

                        <p class="text-gray-600">
                            {{ $profil->no_hp }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold">Email</h4>

                        <p class="text-gray-600">
                            {{ $profil->email }}
                        </p>

                    </div>

                    <div>

                        <h4 class="font-semibold">Jam Operasional</h4>

                        <p class="text-gray-600">
                            {{ $profil->jam_operasional }}
                        </p>

                    </div>

                </div>

            </div>

            <div>

                {!! $profil->maps_embed !!}

            </div>

        </div>

    </div>

</section>