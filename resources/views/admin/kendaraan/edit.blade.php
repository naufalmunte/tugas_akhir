@extends('layouts.app')
@section('title', 'Edit Kendaraan')
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Edit Kendaraan</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui data kendaraan milik pelanggan.</p>
                </div>
                <a href="{{ route('admin.kendaraan.index') }}"
                    class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                {{-- Kolom Kiri: Info Pelanggan --}}
                <div class="md:col-span-1 space-y-4">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 text-center">
                        <div
                            class="w-14 h-14 bg-[#5AA8D6]/10 text-[#5AA8D6] rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-user-tie text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $kendaraan->pelanggan->nama }}</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">{{ $kendaraan->pelanggan->no_hp }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <span
                                class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fa-solid fa-check-circle"></i> Pelanggan Terdaftar
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Form Kendaraan --}}
                <div class="md:col-span-2 border-t md:border-t-0 md:border-l border-gray-100 md:pl-6">
                    <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kendaraan</label>
                            <div class="relative">
                                <i class="fa-solid fa-car absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select name="jenis_kendaraan"
                                    class="bg-gray-50 border {{ $errors->has('jenis_kendaraan') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                    <option value="Mobil"
                                        {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Mobil' ? 'selected' : '' }}>
                                        Mobil</option>
                                    <option value="Motor"
                                        {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Motor' ? 'selected' : '' }}>
                                        Motor</option>
                                </select>
                            </div>
                            @error('jenis_kendaraan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Plat Nomor</label>
                            <div class="relative">
                                <i class="fa-solid fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="plat_nomor"
                                    class="bg-gray-50 border {{ $errors->has('plat_nomor') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5 uppercase"
                                    value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}"
                                    placeholder="Contoh: BA 1234 XY">
                            </div>
                            @error('plat_nomor')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Merk</label>
                            <div class="relative">
                                <i class="fa-solid fa-tags absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="merk"
                                    class="bg-gray-50 border {{ $errors->has('merk') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                    value="{{ old('merk', $kendaraan->merk) }}" placeholder="Contoh: Toyota Avanza">
                            </div>
                            @error('merk')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="w-full md:w-auto px-6 py-2.5 bg-[#5AA8D6] text-white font-medium text-sm rounded-lg hover:bg-[#3A4163] transition focus:ring-4 focus:outline-none focus:ring-blue-300 flex items-center justify-center">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
