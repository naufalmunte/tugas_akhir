@extends('layouts.app')

@section('title','Edit Karyawan')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="heading mb-6 text-2xl font-semibold text-gray-800">Edit Karyawan</h1>

    <form action="{{ route('admin.karyawan.update',$karyawan->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="form-label">Nama Karyawan</label>
            <div class="relative">
                <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="nama" class="form-input pl-10" value="{{ old('nama',$karyawan->nama) }}">
            </div>
            @error('nama')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="form-label">Nomor HP</label>
            <div class="relative">
                <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="no_hp" class="form-input pl-10" value="{{ old('no_hp',$karyawan->no_hp) }}">
            </div>
            @error('no_hp')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.karyawan.index') }}" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                <i class="fa-solid fa-floppy-disk mr-1"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection