@extends('layouts.app')
@section('title', 'Edit Periode Gaji')

@section('content')
    <div class="mx-auto max-w-4xl rounded-xl bg-white p-6 shadow-sm border border-gray-100">
        <div class="mb-5 border-b border-gray-100 pb-4">
            <h1 class="text-xl font-bold text-gray-900">Edit Periode Gaji</h1>
            <p class="mt-1 text-sm text-gray-500">Ubah data periode gaji karyawan.</p>
        </div>

        <form action="{{ route('owner.periode-gaji.update', $periode->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-900">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $periode->tahun) }}" min="2025"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-[#5AA8D6] focus:ring-[#5AA8D6] focus:outline-none">
                    @error('tahun')
                        <small class="mt-1 block text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-900">Bulan</label>
                    <select name="bulan"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-[#5AA8D6] focus:ring-[#5AA8D6] focus:outline-none">
                        <option value="">Pilih Bulan</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}"
                                {{ old('bulan', $periode->bulan) == $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach
                    </select>
                    @error('bulan')
                        <small class="mt-1 block text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-900">
                        Persentase Gaji Karyawan
                    </label>

                    <div class="relative">
                        <input type="number" name="persentase_gaji"
                            value="{{ old('persentase_gaji', $periode->persentase_gaji) }}" min="1" max="100"
                            step="0.01"
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pr-10 text-sm text-gray-900 focus:border-[#5AA8D6] focus:ring-[#5AA8D6] focus:outline-none">

                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                            %
                        </span>
                    </div>

                    @error('persentase_gaji')
                        <small class="mt-1 block text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('owner.periode-gaji.index') }}"
                    class="rounded-lg bg-white border border-gray-200 px-5 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                    class="flex items-center rounded-lg bg-[#5AA8D6] px-5 py-2 text-sm font-medium text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Perbarui
                </button>
            </div>
        </form>
    </div>
@endsection
