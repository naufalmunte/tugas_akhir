@extends('layouts.app')

@section('title','Edit Layanan')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="heading mb-6 text-2xl font-semibold text-gray-800">Edit Layanan</h1>

    <form action="{{ route('admin.layanan.update',$layanan->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="form-label">Kategori Layanan</label>
            <div class="relative">
                <i class="fa-solid fa-layer-group absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <select name="kategori_layanan_id" class="form-input pl-10">
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('kategori_layanan_id',$layanan->kategori_layanan_id)==$item->id?'selected':'' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="form-label">Nama Layanan</label>
            <div class="relative">
                <i class="fa-solid fa-soap absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="nama_layanan" class="form-input pl-10" value="{{ old('nama_layanan',$layanan->nama_layanan) }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <div>
                <label class="form-label">Harga</label>
                <div class="relative">
                    <i class="fa-solid fa-money-bill-wave absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="number" name="harga" class="form-input pl-10" value="{{ old('harga',$layanan->harga) }}">
                </div>
            </div>

            <div>
                <label class="form-label">Estimasi (Menit)</label>
                <div class="relative">
                    <i class="fa-solid fa-clock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="number" name="estimasi_menit" class="form-input pl-10" value="{{ old('estimasi_menit',$layanan->estimasi_menit) }}">
                </div>
            </div>
        </div>

        <div>
            <label class="form-label">Deskripsi</label>
            <div class="relative">
                <i class="fa-solid fa-align-left absolute left-3 top-4 text-gray-400"></i>
                <textarea name="deskripsi" rows="4" class="form-input pl-10">{{ old('deskripsi',$layanan->deskripsi) }}</textarea>
            </div>
        </div>

        <div>
            <label class="form-label">Status</label>
            <div class="relative">
                <i class="fa-solid fa-circle-check absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <select name="status" class="form-input pl-10">
                    <option value="aktif" {{ old('status',$layanan->status)=='aktif'?'selected':'' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status',$layanan->status)=='nonaktif'?'selected':'' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.layanan.index') }}" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                <i class="fa-solid fa-floppy-disk mr-1"></i>Update
            </button>
        </div>
    </form>
</div>
@endsection