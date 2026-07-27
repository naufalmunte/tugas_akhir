@extends('layouts.app')
@section('title', 'Detail Periode Gaji')

@section('content')
<div class="rounded-xl bg-white p-6 shadow-sm">

    <div class="mb-6">
        <h1 class="heading text-2xl font-semibold text-gray-800">Detail Periode Gaji</h1>
        <p class="body-text text-sm text-gray-500">
            Informasi hasil proses penggajian pada periode yang dipilih.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Periode
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                {{ $periode->bulan }} {{ $periode->tahun }}
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Status
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                    {{ $periode->status }}
                </span>
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Gaji per Order
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                Rp {{ number_format($periode->gaji_per_order, 0, ',', '.') }}
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Jumlah Karyawan
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                {{ $periode->gaji->count() }} Orang
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Total Order
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3">
                {{ $periode->gaji->sum('jumlah_order') }} Order
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Total Pengeluaran Gaji
            </label>

            <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 font-semibold text-[#3A4163]">
                Rp {{ number_format($periode->gaji->sum('total_gaji'), 0, ',', '.') }}
            </div>
        </div>

    </div>

    <div class="mt-8 flex justify-end gap-3">

        <a href="{{ route('owner.periode-gaji.index') }}"
            class="rounded-lg bg-gray-500 px-5 py-2 text-white transition hover:bg-gray-600">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali
        </a>

        <a href="{{ route('owner.laporan.gaji')}}""
            class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-white transition hover:bg-[#3A4163]">
            <i class="fa-solid fa-file-lines mr-2"></i>
            Lihat Laporan Gaji
        </a>

    </div>

</div>
@endsection