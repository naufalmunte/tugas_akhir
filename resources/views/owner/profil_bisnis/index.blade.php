@extends('layouts.app')

@section('title', 'Profil Bisnis')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="heading text-2xl font-semibold text-gray-800">Profil Bisnis</h1>
            <p class="body-text text-sm text-gray-500">
                Kelola informasi profil usaha yang ditampilkan pada sistem.
            </p>
        </div>
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-lg border bg-white">
            <form action="{{ route('owner.profil-bisnis.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6">
                    {{-- FORM --}}
                    <div class="lg:col-span-2 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Usaha
                                </label>
                                <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $profil->nama_usaha) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Nomor HP
                                </label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $profil->no_hp) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <input type="email" name="email" value="{{ old('email', $profil->email) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Jam Operasional
                                </label>
                                <input type="text" name="jam_operasional"
                                    value="{{ old('jam_operasional', $profil->jam_operasional) }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Alamat
                            </label>
                            <textarea name="alamat" rows="3"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Google Maps Embed
                            </label>

                            <textarea name="maps_embed" rows="3"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">{{ old('maps_embed', $profil->maps_embed) }}</textarea>
                            <p class="mt-2 text-xs text-gray-500">
                                Salin URL Google Maps Embed.
                            </p>
                        </div>
                    </div>

                    {{-- LOGO --}}
                    <div class="space-y-5">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                Logo Usaha
                            </label>

                            @if ($profil->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}"
                                    class="w-full h-60 object-contain rounded-lg border bg-gray-50 p-3">
                            @else
                                <div
                                    class="flex h-60 items-center justify-center rounded-lg border border-dashed text-gray-400">
                                    Belum Ada Logo
                                </div>
                            @endif
                        </div>

                        <div>
                            <input type="file" name="logo"
                                class="block w-full rounded-lg border border-gray-300 text-sm">
                        </div>

                        <button type="submit"
                            class="w-full rounded-lg bg-[#5AA8D6] px-4 py-3 font-medium text-white transition hover:bg-[#4a97c5]">
                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
