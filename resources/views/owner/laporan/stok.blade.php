@extends('layouts.app')
@section('title', 'Laporan Stok')
@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Laporan Stok</h1>
                <p class="mt-1 text-sm text-gray-500">Laporan aktivitas stok masuk dan keluar.</p>
            </div>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center gap-3">
                    <input type="month" name="bulan" value="{{ request('bulan') }}" class="rounded-lg border px-3 py-2">
                    <button class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]"><i
                            class="fa-solid fa-filter mr-2"></i>Filter</button>
                    <a href="{{ route('owner.laporan.stok') }}"
                        class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">Reset</a>
                </form>
                <a href="{{ route('owner.laporan.stok.cetak', ['tanggal' => request('tanggal'), 'bulan' => request('bulan')]) }}"
                    target="_blank" class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-grey-700"><i
                        class="fa-solid fa-print mr-2"></i>Cetak</a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3">Tanggal</th>
                        <th class="border px-4 py-3">Barang</th>
                        <th class="border px-4 py-3 text-center">Jenis</th>
                        <th class="border px-4 py-3 text-center">Jumlah</th>
                        <th class="border px-4 py-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stok as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $stok->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-3">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td class="border px-4 py-3">{{ $item->stok->nama_barang }}</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->jenis == 'Masuk')
                                    <span class="rounded-lg bg-green-100 px-3 py-1 text-xs text-green-700">Masuk</span>
                                @else
                                    <span class="rounded-lg bg-red-100 px-3 py-1 text-xs text-red-700">Keluar</span>
                                @endif
                            </td>
                            <td class="border px-4 py-3 text-center">{{ $item->jumlah }} {{ $item->stok->satuan }}</td>
                            <td class="border px-4 py-3">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-6 text-center text-gray-500">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            {{ $stok->links() }}
        </div>
    </div>
@endsection
