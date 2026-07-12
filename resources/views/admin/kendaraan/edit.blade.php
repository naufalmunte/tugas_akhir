@extends('layouts.app')

@section('title','Edit Kendaraan')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="heading mb-6 text-2xl font-semibold text-gray-800">Edit Kendaraan</h1>

    <form action="{{ route('admin.kendaraan.update',$kendaraan->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="form-label">Pelanggan</label>
            <div class="rounded-lg border border-gray-300 bg-gray-100 p-3">
                <p class="font-medium text-gray-800">{{ $kendaraan->pelanggan->nama }}</p>
                <p class="text-sm text-gray-500">{{ $kendaraan->pelanggan->no_hp }}</p>
            </div>
        </div>

        <div>
            <label class="form-label">Jenis Kendaraan</label>
            <div class="relative">
                <i class="fa-solid fa-car absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <select name="jenis_kendaraan" class="form-input pl-10">
                    <option value="Mobil" {{ old('jenis_kendaraan',$kendaraan->jenis_kendaraan)=='Mobil'?'selected':'' }}>Mobil</option>
                    <option value="Motor" {{ old('jenis_kendaraan',$kendaraan->jenis_kendaraan)=='Motor'?'selected':'' }}>Motor</option>
                </select>
            </div>
            @error('jenis_kendaraan')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="form-label">Plat Nomor</label>
            <div class="relative">
                <i class="fa-solid fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="plat_nomor" class="form-input pl-10" value="{{ old('plat_nomor',$kendaraan->plat_nomor) }}">
            </div>
            @error('plat_nomor')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label class="form-label">Merk</label>
            <div class="relative">
                <i class="fa-solid fa-tags absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="merk" class="form-input pl-10" value="{{ old('merk',$kendaraan->merk) }}">
            </div>
            @error('merk')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.kendaraan.index') }}" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                <i class="fa-solid fa-floppy-disk mr-1"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection