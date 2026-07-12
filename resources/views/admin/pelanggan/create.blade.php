@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm">
            <div class="border-b px-6 py-4">

                <h1 class="heading text-2xl font-semibold text-gray-800">Tambah Pelanggan</h1>
                <p class="body-text text-sm text-gray-500">Masukkan data pelanggan baru.</p>
            </div>

            <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="form-label">Nama Pelanggan</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="nama" class="form-input pl-10" placeholder="Masukkan nama pelanggan">
                    </div>
                </div>

                <div>
                    <label class="form-label">Nomor HP</label>
                    <div class="relative">
                        <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="no_hp" class="form-input pl-10" placeholder="Masukkan nomor HP">
                    </div>
                </div>

                <div>
                    <label class="form-label">Alamat</label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-3 top-4 text-gray-400"></i>
                        <textarea name="alamat" rows="3" class="form-input pl-10" placeholder="Masukkan alamat pelanggan"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.pelanggan.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-2 font-medium text-gray-700 transition hover:bg-gray-100">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-lg bg-[#5AA8D6] px-5 py-2 font-medium text-white transition hover:bg-[#3A4163]">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection
