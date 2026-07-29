@extends('layouts.app')
@section('title', 'Edit Layanan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Edit Layanan</h1>
                    <p class="text-sm text-gray-500 mt-1">Perbarui detail layanan yang sudah ada.</p>
                </div>
                <a href="{{ route('admin.layanan.index') }}"
                    class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Kategori Layanan</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-layer-group absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select name="kategori_layanan_id"
                                    class="bg-gray-50 border {{ $errors->has('kategori_layanan_id') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kategori_layanan_id', $layanan->kategori_layanan_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kategori_layanan_id')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Nama Layanan</label>
                            <div class="relative">
                                <i class="fa-solid fa-soap absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="nama_layanan"
                                    class="bg-gray-50 border {{ $errors->has('nama_layanan') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                    value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                                    placeholder="Masukkan nama layanan">
                            </div>
                            @error('nama_layanan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Harga (Rp)</label>
                                <div class="relative">
                                    <i
                                        class="fa-solid fa-money-bill-wave absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="number" name="harga"
                                        class="bg-gray-50 border {{ $errors->has('harga') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                        value="{{ old('harga', $layanan->harga) }}" placeholder="Contoh: 50000">
                                </div>
                                @error('harga')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Estimasi (Menit)</label>
                                <div class="relative">
                                    <i class="fa-solid fa-clock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="number" name="estimasi_menit"
                                        class="bg-gray-50 border {{ $errors->has('estimasi_menit') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                        value="{{ old('estimasi_menit', $layanan->estimasi_menit) }}"
                                        placeholder="Contoh: 45">
                                </div>
                                @error('estimasi_menit')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-circle-check absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                    <option value="aktif"
                                        {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif"
                                        {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                            <div class="relative">
                                <i class="fa-solid fa-align-left absolute left-3 top-3.5 text-gray-400"></i>
                                <textarea name="deskripsi" rows="5"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                    placeholder="Masukkan deskripsi layanan">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 mt-8 pt-5 border-t border-gray-100">
                    <button type="submit"
                        class="w-full md:w-auto px-6 py-2.5 bg-[#5AA8D6] text-white font-medium text-sm rounded-lg hover:bg-[#3A4163] transition focus:ring-4 focus:outline-none focus:ring-blue-300 flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
