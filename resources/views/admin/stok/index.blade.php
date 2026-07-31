@extends('layouts.app')
@section('title', 'Manajemen Stok')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100">
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Stok</h1>
                <p class="mt-1 text-sm text-gray-500">Kelola data stok barang dan riwayat keluar masuk barang.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button type="button" data-modal-target="modalTambahBarang" data-modal-toggle="modalTambahBarang"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#3A4163] transition shadow-sm">
                    Tambah Barang
                </button>
                <button type="button" data-modal-target="modalMasuk" data-modal-toggle="modalMasuk"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition shadow-sm">
                    Stok Masuk
                </button>
                <button type="button" data-modal-target="modalKeluar" data-modal-toggle="modalKeluar"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700 transition shadow-sm">
                    Stok Keluar
                </button>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 whitespace-nowrap">
                    <tr>
                        <th class="border px-3 py-2 text-center">No</th>
                        <th class="border px-3 py-2 text-left">Nama Barang</th>
                        <th class="border px-3 py-2 text-center">Satuan</th>
                        <th class="border px-3 py-2 text-center">Stok</th>
                        <th class="border px-3 py-2 text-center">Minimum</th>
                        <th class="border px-3 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stok as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center whitespace-nowrap">
                                {{ $stok->firstItem() + $loop->index }}</td>
                            <td class="border px-3 py-2 font-medium text-gray-900">{{ $item->nama_barang }}</td>
                            <td class="border px-3 py-2 text-center whitespace-nowrap">{{ $item->satuan }}</td>
                            <td class="border px-3 py-2 text-center font-bold text-gray-900 whitespace-nowrap">
                                {{ $item->stok }}</td>
                            <td class="border px-3 py-2 text-center whitespace-nowrap">{{ $item->stok_minimum }}</td>
                            <td class="border px-3 py-2 text-center whitespace-nowrap">
                                @if ($item->stok == 0)
                                    <span
                                        class="rounded-lg bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Habis</span>
                                @elseif($item->stok <= $item->stok_minimum)
                                    <span
                                        class="rounded-lg bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-700">Menipis</span>
                                @else
                                    <span
                                        class="rounded-lg bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">Aman</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">Belum ada data stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($stok->hasPages())
            <div class="mt-4">
                {{ $stok->links() }}
            </div>
        @endif
    </div>

    <div class="mt-6 rounded-xl bg-white p-6 shadow-sm border border-gray-100">
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                Riwayat Aktivitas Stok
            </h2>
            <p class="mt-1 text-sm text-gray-500">Daftar riwayat keluar masuk stok barang.</p>
        </div>
        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 whitespace-nowrap">
                    <tr>
                        <th class="border px-3 py-2 text-center">No</th>
                        <th class="border px-3 py-2 text-left">Tanggal</th>
                        <th class="border px-3 py-2 text-left">Barang</th>
                        <th class="border px-3 py-2 text-center">Jenis</th>
                        <th class="border px-3 py-2 text-center">Jumlah</th>
                        <th class="border px-3 py-2 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center whitespace-nowrap">
                                {{ $transaksi->firstItem() + $loop->index }}
                            </td>
                            <td class="border px-3 py-2 text-gray-600 whitespace-nowrap">
                                {{ $item->created_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="border px-3 py-2 font-medium text-gray-900">
                                {{ $item->stok->nama_barang }}
                            </td>
                            <td class="border px-3 py-2 text-center whitespace-nowrap">
                                @if ($item->jenis == 'Masuk')
                                    <span class="rounded-lg bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        <i class="fa-solid fa-arrow-down mr-1"></i> Masuk
                                    </span>
                                @else
                                    <span class="rounded-lg bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        <i class="fa-solid fa-arrow-up mr-1"></i> Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="border px-3 py-2 text-center font-bold text-gray-900 whitespace-nowrap">
                                {{ $item->jumlah }}
                            </td>
                            <td class="border px-3 py-2 text-gray-600">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                                Belum ada aktivitas stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($transaksi->hasPages())
            <div class="mt-4">
                {{ $transaksi->links() }}
            </div>
        @endif
    </div>

    <div id="modalTambahBarang" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-lg font-bold text-gray-900">Tambah Barang Baru</h3>
                <button type="button" data-modal-hide="modalTambahBarang"
                    class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                </button>
            </div>
            <form action="{{ route('admin.stok.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nama Barang</label>
                        <div class="relative">
                            <input type="text" name="nama_barang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                placeholder="Masukkan nama barang" required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Satuan</label>
                        <div class="relative">
                            <select name="satuan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                required>
                                <option value="Botol">Botol</option>
                                <option value="Liter">Liter</option>
                                <option value="Pcs">Pcs</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Stok Awal</label>
                            <div class="relative">
                                <input type="number" name="stok" min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                    placeholder="0" required>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Min. Stok</label>
                            <div class="relative">
                                <input type="number" name="stok_minimum" min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5"
                                    placeholder="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button type="button" data-modal-hide="modalTambahBarang"
                        class="rounded-lg bg-white border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-[#5AA8D6] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#3A4163] transition flex items-center">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalMasuk" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-lg font-bold text-gray-900">Catat Stok Masuk</h3>
                <button type="button" data-modal-hide="modalMasuk"
                    class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.stok.transaksi') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="jenis" value="Masuk">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Pilih Barang</label>
                            <div class="relative">
                                <select name="stok_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5"
                                    required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($stokDropdown as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Jumlah Masuk</label>
                            <div class="relative">
                                <input type="number" min="1" name="jumlah"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5"
                                    placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <div class="relative">
                            <textarea name="keterangan" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5"
                                placeholder="Contoh: Pembelian dari supplier"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button type="button" data-modal-hide="modalMasuk"
                        class="rounded-lg bg-white border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition flex items-center">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalKeluar" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-2xl rounded-xl bg-white shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-lg font-bold text-gray-900">Catat Stok Keluar</h3>
                <button type="button" data-modal-hide="modalKeluar"
                    class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                </button>
            </div>
            <form action="{{ route('admin.stok.transaksi') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="jenis" value="Keluar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Pilih Barang</label>
                            <div class="relative">
                                <select name="stok_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5"
                                    required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($stokDropdown as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_barang }} (Sisa:
                                            {{ $item->stok }} {{ $item->satuan }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Jumlah Keluar</label>
                            <div class="relative">
                                <input type="number" min="1" name="jumlah"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5"
                                    placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <div class="relative">
                            <textarea name="keterangan" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5"
                                placeholder="Contoh: Pemakaian operasional"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button type="button" data-modal-hide="modalKeluar"
                        class="rounded-lg bg-white border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 transition flex items-center">
                         Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modalTambah = document.getElementById('modalTambahBarang');
        const modalMasuk = document.getElementById('modalMasuk');
        const modalKeluar = document.getElementById('modalKeluar');

        document.getElementById('btnTambahBarang').addEventListener('click', () => {
            modalTambah.classList.remove('hidden');
            modalTambah.classList.add('flex');
        });

        document.getElementById('btnCloseTambah').addEventListener('click', () => {
            modalTambah.classList.remove('flex');
            modalTambah.classList.add('hidden');
        });

        document.getElementById('btnStokMasuk').addEventListener('click', () => {
            modalMasuk.classList.remove('hidden');
            modalMasuk.classList.add('flex');
        });

        document.getElementById('btnCloseMasuk').addEventListener('click', () => {
            modalMasuk.classList.remove('flex');
            modalMasuk.classList.add('hidden');
        });

        document.getElementById('btnStokKeluar').addEventListener('click', () => {
            modalKeluar.classList.remove('hidden');
            modalKeluar.classList.add('flex');
        });

        document.getElementById('btnCloseKeluar').addEventListener('click', () => {
            modalKeluar.classList.remove('flex');
            modalKeluar.classList.add('hidden');
        });
    </script>
@endsection
