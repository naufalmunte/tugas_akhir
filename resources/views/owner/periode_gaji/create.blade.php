@extends('layouts.app')
@section('title', 'Tambah Periode Gaji')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <div class="mb-6">
            <h1 class="heading text-2xl font-semibold text-gray-800">
                Tambah Periode Gaji
            </h1>
            <p class="body-text text-sm text-gray-500">
                Tambahkan periode gaji baru.
            </p>
        </div>

        <form action="{{ route('owner.periode-gaji.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Tahun
                    </label>

                    <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" min="2025"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                    @error('tahun')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Bulan
                    </label>

                    <select name="bulan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                        <option value="">-- Pilih Bulan --</option>

                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach

                    </select>

                    @error('bulan')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Gaji per Order
                    </label>

                    <input type="number" name="gaji_per_order" value="{{ old('gaji_per_order') }}" min="1000"
                        placeholder="Masukkan nominal gaji per order"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">

                    @error('gaji_per_order')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                    <p class="mt-2 text-sm text-gray-500">
                        Sistem akan otomatis menghitung gaji seluruh karyawan berdasarkan order yang selesai pada periode
                        yang dipilih.
                    </p>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('owner.periode-gaji.index') }}"
                    class="rounded-lg bg-gray-500 px-5 py-2 text-white transition hover:bg-gray-600">
                    Kembali
                </a>

                <button type="submit" class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-white transition hover:bg-[#3A4163]">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan

                </button>

            </div>

        </form>

    </div>
@endsection
