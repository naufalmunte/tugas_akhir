@extends('layouts.app')
@section('title', 'Laporan Pendapatan')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Laporan Pendapatan</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Data pendapatan dari order yang telah selesai.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <form action="{{ route('owner.laporan.pendapatan') }}" method="GET"
                    class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                    <input type="month" name="bulan" value="{{ request('bulan') }}"
                        class="w-full sm:w-auto rounded-lg border border-gray-300 px-3 py-2 focus:border-[#5AA8D6] focus:outline-none">
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="submit"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">
                            <i class="fa-solid fa-filter mr-2"></i>
                            Filter
                        </button>
                        <a href="{{ route('owner.laporan.pendapatan') }}"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </form>
                <a href="{{ route('owner.laporan.pendapatan.cetak', [
                    'bulan' => request('bulan'),
                ]) }}"
                    target="_blank"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">
                    <i class="fa-solid fa-print"></i>
                    Cetak
                </a>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-2">
            <div class="rounded-xl bg-blue-50 border border-blue-100 p-5">
                <p class="text-sm font-medium text-blue-800">
                    Total Order Selesai
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $totalOrder }}
                </h2>
            </div>

            <div class="rounded-xl bg-green-50 border border-green-100 p-5">
                <p class="text-sm font-medium text-green-800">
                    Total Pendapatan
                </p>
                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-center">Tanggal</th>
                        <th class="border px-4 py-3 text-left">Pelanggan</th>
                        <th class="border px-4 py-3 text-left">Layanan</th>
                        <th class="border px-4 py-3 text-center">Metode</th>
                        <th class="border px-4 py-3 text-end">Pendapatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendapatan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">
                                {{ $pendapatan->firstItem() + $loop->index }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->pelanggan->nama }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->layanan->nama_layanan }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->metode_pembayaran == 'Cash')
                                    <span class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        Cash
                                    </span>
                                @else
                                    <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                        QRIS
                                    </span>
                                @endif
                            </td>
                            <td class="border px-4 py-3 text-end font-semibold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                                Belum ada data pendapatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pendapatan->hasPages())
            <div class="mt-6">
                {{ $pendapatan->links() }}
            </div>
        @endif
    </div>
@endsection
