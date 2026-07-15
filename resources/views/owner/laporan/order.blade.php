@extends('layouts.app')

@section('title', 'Laporan Order')

@section('content')

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Laporan Order
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Data laporan seluruh order.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('owner.laporan.order') }}" method="GET" class="flex items-center gap-3">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="rounded-lg border px-3 py-2">
                    <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Filter
                    </button>
                    <a href="{{ route('owner.laporan.order') }}" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">
                        Reset
                    </a>
                </form>

                <a href="{{ route('owner.laporan.order.cetak', ['tanggal' => request('tanggal')]) }}"
                    target="_blank" class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                    <i class="fa-solid fa-print mr-2"></i>
                    Cetak
                </a>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-2">
            <div class="rounded-lg bg-blue-50 p-5">
                <p class="text-sm text-gray-500">
                    Total Order
                </p>

                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $totalOrder }}
                </h2>
            </div>

            <div class="rounded-lg bg-green-50 p-5">
                <p class="text-sm text-gray-500">
                    Total Pendapatan
                </p>
                <h2 class="mt-2 text-3xl font-bold text-green-600">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">
                            No
                        </th>
                        <th class="border px-4 py-3">
                            Tanggal
                        </th>
                        <th class="border px-4 py-3">
                            Pelanggan
                        </th>
                        <th class="border px-4 py-3">
                            Layanan
                        </th>
                        <th class="border px-4 py-3">
                            Karyawan
                        </th>
                        <th class="border px-4 py-3 text-center">
                            Harga
                        </th>
                        <th class="border px-4 py-3 text-center">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">
                                {{ $order->firstItem() + $loop->index }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->pelanggan->nama }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->layanan->nama_layanan }}
                            </td>
                            <td class="border px-4 py-3">
                                {{ $item->karyawan->nama ?? '-' }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->antrean)
                                    @switch($item->antrean->status)
                                        @case('Menunggu')
                                            <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs text-gray-700">
                                                Menunggu
                                            </span>
                                        @break

                                        @case('Diproses')
                                            <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs text-blue-700">
                                                Diproses
                                            </span>
                                        @break

                                        @case('Menunggu Pembayaran')
                                            <span class="rounded-lg bg-yellow-100 px-3 py-1 text-xs text-yellow-700">
                                                Menunggu Pembayaran
                                            </span>
                                        @break

                                        @case('Selesai')
                                            <span class="rounded-lg bg-green-100 px-3 py-1 text-xs text-green-700">
                                                Selesai
                                            </span>
                                        @break
                                    @endswitch
                                @else
                                    <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs">
                                        -
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                    Belum ada data order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    @endsection
