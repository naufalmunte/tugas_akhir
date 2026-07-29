@extends('layouts.app')
@section('title', 'Tambah Kategori Layanan')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
        <div class="border-b px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-900">Tambah Kategori Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan data kategori layanan baru.</p>
        </div>

        <form action="{{ route('admin.kategori-layanan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                <div class="relative">
                    <i class="fa-solid fa-layer-group absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="nama_kategori"
                        class="bg-gray-50 border {{ $errors->has('nama_kategori') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                        placeholder="Masukkan nama kategori" value="{{ old('nama_kategori') }}">
                </div>
                @error('nama_kategori')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Butuh Kendaraan?</label>
                <select name="butuh_kendaraan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <div class="relative">
                    <i class="fa-solid fa-align-left absolute left-3 top-3.5 text-gray-400"></i>
                    <textarea name="deskripsi" rows="2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                        placeholder="Masukkan deskripsi kategori layanan">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.kategori-layanan.index') }}"
                    class="py-2 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">Batal</a>
                <button type="submit"
                    class="py-2 px-5 text-sm font-medium text-white bg-[#5AA8D6] hover:bg-[#3A4163] rounded-lg transition flex items-center">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
