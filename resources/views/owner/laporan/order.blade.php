@extends('layouts.app')
@section('title', 'Laporan Order')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <!-- Header & Filter: Diperbaiki biar tidak keluar layar di HP -->
        <div class="mb-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Laporan Order</h1>
                <p class="mt-1 text-sm text-gray-500">Data laporan seluruh order.</p>
            </div>

            <!-- Pembungkus Form & Cetak -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                <form action="{{ route('owner.laporan.order') }}" method="GET"
                    class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                    <!-- Input Tanggal: Penuh di HP, menyesuaikan di Desktop -->
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                        class="w-full sm:w-auto rounded-lg border border-gray-300 px-3 py-2 focus:border-[#5AA8D6] focus:outline-none">

                    <!-- Grup Tombol Filter & Reset: Dibagi dua sama rata di HP (flex-1) -->
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="submit"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">
                            <i class="fa-solid fa-filter mr-2"></i> Filter
                        </button>
                        <a href="{{ route('owner.laporan.order') }}"
                            class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </form>

                <a href="{{ route('owner.laporan.order.cetak', ['tanggal' => request('tanggal')]) }}" target="_blank"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">
                    <i class="fa-solid fa-print"></i> Cetak
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-2">
            <div class="rounded-xl bg-blue-50 border border-blue-100 p-5 hover:shadow-md transition-shadow">
                <p class="text-sm font-medium text-blue-800">Total Order</p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">{{ $totalOrder }}</h2>
            </div>
            <div class="rounded-xl bg-green-50 border border-green-100 p-5 hover:shadow-md transition-shadow">
                <p class="text-sm font-medium text-green-800">Total Pendapatan</p>
                <h2 class="mt-2 text-3xl font-bold text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-center">Tanggal</th>
                        <th class="border px-4 py-3 text-left">Pelanggan</th>
                        <th class="border px-4 py-3 text-left">Layanan</th>
                        <th class="border px-4 py-3 text-left">Karyawan</th>
                        <th class="border px-4 py-3 text-end">Harga</th>
                        <th class="border px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $order->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-3 text-center text-gray-600">{{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td class="border px-4 py-3 font-medium text-gray-800">{{ $item->pelanggan->nama }}</td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->layanan->nama_layanan }}</td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->karyawan->nama ?? '-' }}</td>
                            <td class="border px-4 py-3 text-end font-semibold text-gray-800">Rp
                                {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->antrean)
                                    @switch($item->antrean->status)
                                        @case('Menunggu')
                                            <span
                                                class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">Menunggu</span>
                                        @break

                                        @case('Diproses')
                                            <span
                                                class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">Diproses</span>
                                        @break

                                        @case('Menunggu Pembayaran')
                                            <span
                                                class="rounded-lg bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">Menunggu
                                                Pembayaran</span>
                                        @break

                                        @case('Selesai')
                                            <span
                                                class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Selesai</span>
                                        @break
                                    @endswitch
                                @else
                                    <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-4 py-8 text-center text-gray-500">Belum ada data laporan
                                    order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            @if ($order->hasPages())
                <div class="mt-6">
                    {{ $order->links() }}
                </div>
            @endif
        </div>
    @endsection
