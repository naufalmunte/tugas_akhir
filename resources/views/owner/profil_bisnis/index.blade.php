@extends('layouts.app')
@section('title', 'Profil Bisnis')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6">        
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <h1 class="text-xl font-bold text-gray-900">Profil Bisnis</h1>
            <p class="mt-1 text-sm text-gray-500">
            </p>
        </div>

        @if (session('success'))
            <div class="flex items-center rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 shadow-sm">
                <i class="fa-solid fa-circle-check mr-2 text-lg"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
            <form action="{{ route('owner.profil-bisnis.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6 md:p-8">
                    <div class="lg:col-span-2 space-y-6">                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Nama Usaha</label>
                                <div class="relative">
                                    <i class="fa-solid fa-store absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $profil->nama_usaha) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="Masukkan nama usaha">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Nomor HP</label>
                                <div class="relative">
                                    <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="no_hp" value="{{ old('no_hp', $profil->no_hp) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="Contoh: 08123456789">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <div class="relative">
                                    <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="email" name="email" value="{{ old('email', $profil->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="email@usaha.com">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Jam Operasional</label>
                                <div class="relative">
                                    <i class="fa-solid fa-clock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $profil->jam_operasional) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="Contoh: 08:00 - 17:00">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
                            <div class="relative">
                                <i class="fa-solid fa-map-location-dot absolute left-3 top-3.5 text-gray-400"></i>
                                <textarea name="alamat" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="Masukkan alamat lengkap usaha">{{ old('alamat', $profil->alamat) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Usaha</label>
                            <div class="relative">
                                <i class="fa-solid fa-align-left absolute left-3 top-3.5 text-gray-400"></i>
                                <textarea name="deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5" placeholder="Tuliskan deskripsi singkat mengenai usaha ini">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 flex items-center justify-between">
                                Google Maps Embed
                                <a href="https://maps.google.com" target="_blank" class="text-xs text-[#5AA8D6] hover:underline flex items-center">
                                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Maps
                                </a>
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-code absolute left-3 top-3.5 text-gray-400"></i>
                                <textarea name="maps_embed" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5 font-mono text-xs" placeholder='<iframe src="https://www.google.com/maps/embed?..."></iframe>'>{{ old('maps_embed', $profil->maps_embed) }}</textarea>
                            </div>
                            <p class="mt-1.5 text-xs text-gray-500"><i class="fa-solid fa-circle-info mr-1"></i> Salin URL/kode Iframe dari fitur "Bagikan > Sematkan Peta" di Google Maps.</p>
                        </div>
                    </div>

                    <div class="lg:border-l lg:border-gray-100 lg:pl-8 space-y-6">
                        <div>
                            <label class="block mb-3 text-sm font-bold text-gray-900 border-b border-gray-100 pb-2">
                                <i class="fa-solid fa-image text-[#5AA8D6] mr-2"></i> Logo Usaha
                            </label>
                            <div class="mb-4 relative group rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-4 transition-all hover:border-[#5AA8D6]">
                                <img id="preview-logo" 
                                     src="{{ $profil->logo ? asset('storage/' . $profil->logo) : '' }}" 
                                     class="mx-auto w-full h-48 object-contain rounded-lg {{ $profil->logo ? '' : 'hidden' }}" 
                                     alt="Preview Logo">
                                
                                <div id="no-logo-text" class="flex flex-col h-48 items-center justify-center text-gray-400 {{ $profil->logo ? 'hidden' : '' }}">
                                    <i class="fa-solid fa-image text-4xl mb-2 text-gray-300"></i>
                                    <span class="text-sm font-medium">Belum Ada Logo</span>
                                </div>
                            </div>
                            <input type="file" name="logo" id="logo-input" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-medium file:bg-[#5AA8D6] file:text-white hover:file:bg-[#3A4163] transition-all">
                            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, JPEG. Max 2MB.</p>
                        </div>

                        <div class="pt-6 border-t border-gray-100">
                            <button type="submit" class="w-full flex justify-center items-center rounded-lg bg-[#5AA8D6] px-5 py-3 font-medium text-white transition hover:bg-[#3A4163] shadow-sm">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                        
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('logo-input').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('preview-logo');
                const noLogoText = document.getElementById('no-logo-text');
                
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                noLogoText.classList.add('hidden');
            }
        });
    </script>
@endsection