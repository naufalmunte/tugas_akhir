@extends('layouts.app')
@section('title', 'Detail Periode Gaji')

@section('content')
    <div class="mx-auto max-w-5xl rounded-xl bg-white p-6 shadow-sm border border-gray-100">
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h1 class="text-xl font-semibold text-gray-800">Detail Periode Gaji</h1>
            <p class="mt-1 text-sm text-gray-500">
                Informasi hasil proses penggajian pada periode yang dipilih.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Periode
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-gray-900">
                    {{ $periode->bulan }} {{ $periode->tahun }}
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Status
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5">
                    <span
                        class="font-medium {{ $periode->status == 'Belum Diproses' ? 'text-yellow-600' : 'text-green-600' }}">
                        {{ $periode->status }}
                    </span>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Gaji per Order
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-gray-900">
                    Rp {{ number_format($periode->gaji_per_order, 0, ',', '.') }}
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Jumlah Karyawan
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-gray-900">
                    {{ $periode->gaji->count() }} Orang
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Total Order
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 text-gray-900">
                    {{ $periode->gaji->sum('jumlah_order') }} Order
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Total Pengeluaran Gaji
                </label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 px-4 py-2.5 font-semibold text-[#3A4163]">
                    Rp {{ number_format($periode->gaji->sum('total_gaji'), 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-5">
            <a href="{{ route('owner.periode-gaji.index') }}"
                class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-600">
                Kembali
            </a>
            <a href="{{ route('owner.laporan.gaji') }}"
                class="rounded-lg bg-[#5AA8D6] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#3A4163]">
                Lihat Laporan Gaji
            </a>
        </div>
    </div>
@endsection
