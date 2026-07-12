@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="heading text-2xl font-semibold text-gray-800">Edit Pelanggan</h1>
            <p class="body-text text-sm text-gray-500">Perbarui data pelanggan.</p>
        </div>

        <div class="rounded-xl bg-white shadow-sm">
            <div class="border-b px-6 py-4">
                <h2 class="heading text-lg font-semibold text-gray-700">Form Pelanggan</h2>
            </div>

            <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST" class="space-y-5 p-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label">Nama Pelanggan</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="nama" class="form-input pl-10"
                            value="{{ old('nama', $pelanggan->nama) }}">
                    </div>
                </div>

                <div>
                    <label class="form-label">Nomor HP</label>
                    <div class="relative">
                        <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="no_hp" class="form-input pl-10"
                            value="{{ old('no_hp', $pelanggan->no_hp) }}">
                    </div>
                </div>

                <div>
                    <label class="form-label">Alamat</label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-3 top-4 text-gray-400"></i>
                        <textarea name="alamat" rows="2" class="form-input pl-10">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.pelanggan.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-2 font-medium text-gray-700 transition hover:bg-gray-100">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-[#5AA8D6] px-5 py-2 font-medium text-white transition hover:bg-[#3A4163]">
                        Perbarui
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
