@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-3xl mx-auto">
        <div class="border-b px-6 py-4">
            <h1 class="text-xl font-semibold text-gray-900">Tambah Pelanggan</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan data pelanggan baru.</p>
        </div>
        <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="p-6 space-y-4 novalidate">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Nama Pelanggan</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Masukkan nama pelanggan" required>
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Nomor HP</label>
                <div class="relative">
                    <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="number" name="no_hp" value="{{ old('no_hp') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Masukkan nomor HP" required>
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                <div class="relative">
                    <i class="fa-solid fa-location-dot absolute left-3 top-3.5 text-gray-400"></i>
                    <textarea name="alamat" rows="2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Masukkan alamat pelanggan" required>{{ old('alamat') }}</textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.pelanggan.index') }}"
                    class="py-2 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">Batal</a>
                <button type="submit"
                    class="py-2 px-5 text-sm font-medium text-white bg-[#5AA8D6] hover:bg-[#3A4163] rounded-lg transition">Simpan</button>
            </div>
        </form>
    </div>
@endsection
