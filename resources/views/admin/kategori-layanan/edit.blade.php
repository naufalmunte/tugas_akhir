@extends('layouts.app')

@section('title', 'Edit Kategori Layanan')

@section('content')
    <div class="mx-auto max-w-2xl rounded-xl bg-white p-6 shadow-sm">
        <h1 class="heading mb-6 text-2xl font-semibold text-gray-800">Edit Kategori Layanan</h1>

        <form action="{{ route('admin.kategori-layanan.update', $kategori->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Nama Kategori</label>
                <div class="relative">
                    <i class="fa-solid fa-layer-group absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="nama_kategori" class="form-input pl-10"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                </div>
                @error('nama_kategori')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="form-label">Butuh Kendaraan</label>
                <select name="butuh_kendaraan" class="form-input">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <div class="relative">
                    <i class="fa-solid fa-align-left absolute left-3 top-4 text-gray-400"></i>
                    <textarea name="deskripsi" rows="4" class="form-input pl-10">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.kategori-layanan.index') }}"
                    class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">Batal</a>
                <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
