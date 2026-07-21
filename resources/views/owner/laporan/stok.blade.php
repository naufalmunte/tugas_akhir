@extends('layouts.app')
@section('title', 'Laporan Stok')

@section('content')
<div class="rounded-xl bg-white p-6 shadow-sm">
    <!-- Header & Filter: Responsif biar nggak bablas di layar HP -->
    <div class="mb-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Laporan Stok</h1>
            <p class="mt-1 text-sm text-gray-500">Laporan aktivitas stok masuk dan keluar.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <form method="GET" class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                <!-- Input Bulan: Penuh di HP, auto di Desktop -->
                <input type="month" name="bulan" value="{{ request('bulan') }}" class="w-full sm:w-auto rounded-lg border border-gray-300 px-3 py-2 focus:border-[#5AA8D6] focus:outline-none">
                
                <!-- Grup Tombol Filter & Reset: Dibagi rata 50:50 di HP -->
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">
                        <i class="fa-solid fa-filter mr-2"></i> Filter
                    </button>
                    <a href="{{ route('owner.laporan.stok') }}" class="flex-1 sm:flex-none flex justify-center items-center rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">
                        Reset
                    </a>
                </div>
            </form>

            <a href="{{ route('owner.laporan.stok.cetak', ['tanggal' => request('tanggal'), 'bulan' => request('bulan')]) }}" target="_blank" class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">
                <i class="fa-solid fa-print"></i> Cetak
            </a>
        </div>
    </div>

    <!-- Tabel diselaraskan gayanya dengan whitespace-nowrap -->
    <div class="overflow-x-auto rounded-lg border bg-white">
        <table class="min-w-full text-sm whitespace-nowrap">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-3 text-center">No</th>
                    <th class="border px-4 py-3 text-center">Tanggal</th>
                    <th class="border px-4 py-3 text-left">Barang</th>
                    <th class="border px-4 py-3 text-center">Jenis</th>
                    <th class="border px-4 py-3 text-center">Jumlah</th>
                    <th class="border px-4 py-3 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stok as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-3 text-center">{{ $stok->firstItem() + $loop->index }}</td>
                        <td class="border px-4 py-3 text-center text-gray-600">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border px-4 py-3 font-medium text-gray-800">{{ $item->stok->nama_barang }}</td>
                        <td class="border px-4 py-3 text-center">
                            @if ($item->jenis == 'Masuk')
                                <span class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Masuk</span>
                            @else
                                <span class="rounded-lg bg-red-100 px-3 py-1 text-xs font-medium text-red-700">Keluar</span>
                            @endif
                        </td>
                        <td class="border px-4 py-3 text-center font-semibold text-gray-800">{{ $item->jumlah }} {{ $item->stok->satuan }}</td>
                        <td class="border px-4 py-3 text-gray-600">{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-8 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginasi -->
    @if($stok->hasPages())
    <div class="mt-6">
        {{ $stok->links() }}
    </div>
    @endif
</div>
@endsection