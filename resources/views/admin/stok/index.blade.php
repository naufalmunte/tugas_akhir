@extends('layouts.app')
@section('title', 'Manajemen Stok')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Manajemen Stok</h1>
                <p class="mt-1 text-sm text-gray-500">Kelola data stok barang dan riwayat keluar masuk barang.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button id="btnTambahBarang"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Barang
                </button>
                <button id="btnStokMasuk"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">
                    <i class="fa-solid fa-arrow-down mr-2"></i> Stok Masuk
                </button>
                <button id="btnStokKeluar"
                    class="flex w-full sm:w-auto justify-center items-center rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700 transition">
                    <i class="fa-solid fa-arrow-up mr-2"></i> Stok Keluar
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg border">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3">Nama Barang</th>
                        <th class="border px-4 py-3 text-center">Satuan</th>
                        <th class="border px-4 py-3 text-center">Stok</th>
                        <th class="border px-4 py-3 text-center">Minimum</th>
                        <th class="border px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stok as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3 font-medium">{{ $item->nama_barang }}</td>
                            <td class="border px-4 py-3 text-center">{{ $item->satuan }}</td>
                            <td class="border px-4 py-3 text-center font-semibold">{{ $item->stok }}</td>
                            <td class="border px-4 py-3 text-center">{{ $item->stok_minimum }}</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->stok == 0)
                                    <span
                                        class="rounded-lg bg-red-100 px-3 py-1 text-xs font-medium text-red-700">Habis</span>
                                @elseif($item->stok <= $item->stok_minimum)
                                    <span
                                        class="rounded-lg bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">Menipis</span>
                                @else
                                    <span
                                        class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Aman</span>
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
    </div>

    <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-xl font-semibold text-gray-800">Riwayat Aktivitas Stok</h2>
        <div class="overflow-x-auto rounded-lg border">
            <table class="min-w-full text-sm whitespace-nowrap">
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
                    @forelse($transaksi as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td class="border px-4 py-3 font-medium">{{ $item->stok->nama_barang }}</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->jenis == 'Masuk')
                                    <span
                                        class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Masuk</span>
                                @else
                                    <span
                                        class="rounded-lg bg-red-100 px-3 py-1 text-xs font-medium text-red-700">Keluar</span>
                                @endif
                            </td>
                            <td class="border px-4 py-3 text-center font-semibold">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-3 text-gray-500">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">Belum ada aktivitas stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalTambahBarang"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 shadow-2xl relative">
            <h2 class="mb-5 text-xl font-semibold text-gray-800">Tambah Barang</h2>
            <form action="{{ route('admin.stok.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-[#5AA8D6] focus:ring focus:ring-[#5AA8D6]/20"
                            required>
                    </div>
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Satuan</label>
                        <select name="satuan"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-[#5AA8D6] focus:ring focus:ring-[#5AA8D6]/20"
                            required>
                            <option value="Botol">Botol</option>
                            <option value="Liter">Liter</option>
                            <option value="Pcs">Pcs</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label block mb-1 text-sm font-medium text-gray-700">Stok Awal</label>
                            <input type="number" name="stok" min="0"
                                class="form-input w-full rounded-lg border-gray-300 focus:border-[#5AA8D6] focus:ring focus:ring-[#5AA8D6]/20"
                                required>
                        </div>
                        <div>
                            <label class="form-label block mb-1 text-sm font-medium text-gray-700">Stok Minimum</label>
                            <input type="number" name="stok_minimum" min="0"
                                class="form-input w-full rounded-lg border-gray-300 focus:border-[#5AA8D6] focus:ring focus:ring-[#5AA8D6]/20"
                                required>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                    <button type="button" id="btnCloseTambah"
                        class="w-full sm:w-auto rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">Batal</button>
                    <button type="submit"
                        class="w-full sm:w-auto rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163] transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalMasuk"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 shadow-2xl relative">
            <h2 class="mb-5 text-xl font-semibold text-gray-800">Catat Stok Masuk</h2>
            <form action="{{ route('admin.stok.transaksi') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis" value="Masuk">
                <div class="space-y-4">
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Barang</label>
                        <select name="stok_id"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200"
                            required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($stok as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Jumlah Masuk</label>
                        <input type="number" min="1" name="jumlah"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200"
                            required>
                    </div>
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                    <button type="button" id="btnCloseMasuk"
                        class="w-full sm:w-auto rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">Batal</button>
                    <button type="submit"
                        class="w-full sm:w-auto rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalKeluar"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 shadow-2xl relative">
            <h2 class="mb-5 text-xl font-semibold text-gray-800">Catat Stok Keluar</h2>
            <form action="{{ route('admin.stok.transaksi') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis" value="Keluar">
                <div class="space-y-4">
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Barang</label>
                        <select name="stok_id"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200"
                            required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($stok as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }} ({{ $item->stok }}
                                    {{ $item->satuan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Jumlah Keluar</label>
                        <input type="number" min="1" name="jumlah"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200"
                            required>
                    </div>
                    <div>
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                    <button type="button" id="btnCloseKeluar"
                        class="w-full sm:w-auto rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">Batal</button>
                    <button type="submit"
                        class="w-full sm:w-auto rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700 transition">Simpan</button>
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
