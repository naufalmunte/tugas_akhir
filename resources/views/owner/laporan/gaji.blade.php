@extends('layouts.app')
@section('title', 'Laporan Gaji')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Laporan Gaji
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Data laporan gaji karyawan.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <form action="{{ route('owner.laporan.gaji') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">

                    <select name="periode"
                        class="w-full sm:w-64 rounded-lg border border-gray-300 px-3 py-2 focus:border-[#5AA8D6] focus:outline-none">
                        <option value="">Semua Periode</option>

                        @foreach ($periode as $item)
                            <option value="{{ $item->id }}" {{ request('periode') == $item->id ? 'selected' : '' }}>
                                {{ $item->bulan }} {{ $item->tahun }}
                            </option>
                        @endforeach
                    </select>

                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="submit"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">
                            <i class="fa-solid fa-filter mr-2"></i>
                            Filter
                        </button>
                        <a href="{{ route('owner.laporan.gaji') }}"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </form>

                <a href="{{ route('owner.laporan.gaji.cetak', ['periode' => request('periode')]) }}" target="_blank"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">
                    <i class="fa-solid fa-print"></i>
                    Cetak
                </a>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-2">
            <div class="rounded-xl border border-blue-100 bg-blue-50 p-5">
                <p class="text-sm font-medium text-blue-800">
                    Total Order
                </p>

                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $totalOrder }}
                </h2>
            </div>

            <div class="rounded-xl border border-green-100 bg-green-50 p-5">
                <p class="text-sm font-medium text-green-800">
                    Total Gaji
                </p>
                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalGaji, 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full whitespace-nowrap text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-left">Karyawan</th>
                        <th class="border px-4 py-3 text-center">Periode</th>
                        <th class="border px-4 py-3 text-center">Jumlah Order</th>
                        <th class="border px-4 py-3 text-end">Gaji / Order</th>
                        <th class="border px-4 py-3 text-end">Total Gaji</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($laporan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">
                                {{ $laporan->firstItem() + $loop->index }}
                            </td>

                            <td class="border px-4 py-3 font-medium">
                                {{ $item->karyawan->nama }}
                            </td>

                            <td class="border px-4 py-3 text-center">
                                {{ $item->periodeGaji->bulan }}
                                {{ $item->periodeGaji->tahun }}
                            </td>

                            <td class="border px-4 py-3 text-center">
                                {{ $item->jumlah_order }}
                            </td>

                            <td class="border px-4 py-3 text-end">
                                Rp {{ number_format($item->periodeGaji->gaji_per_order, 0, ',', '.') }}
                            </td>

                            <td class="border px-4 py-3 text-end font-semibold">
                                Rp {{ number_format($item->total_gaji, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                                Belum ada data laporan gaji.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($laporan->hasPages())
            <div class="mt-6">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>
@endsection
