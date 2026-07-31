@extends('layouts.app')
@section('title', 'Kelola Antrean')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Proses Layanan</h1>
                <p class="body-text text-sm text-gray-500">Kelola proses layanan kendaraan dan karpet.</p>
            </div>
        </div>

        <div class="mb-6 border-b">
            <nav class="flex gap-6">
                <button id="tab-kendaraan" type="button"
                    class="border-b-2 border-[#5AA8D6] pb-3 font-semibold text-[#5AA8D6]">
                    Kendaraan
                </button>
                <button id="tab-karpet" type="button" class="pb-3 font-semibold text-gray-500">
                    Karpet
                </button>
            </nav>
        </div>

        <div id="kendaraan-content">
            <div class="overflow-x-auto rounded-lg border bg-white">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 whitespace-nowrap">
                        <tr>
                            <th class="border px-3 py-2 text-center">No</th>
                            <th class="border px-3 py-2 text-center">No Antrean</th>
                            <th class="border px-3 py-2 text-left">Pelanggan</th>
                            <th class="border px-3 py-2 text-left">Kendaraan</th>
                            <th class="border px-3 py-2 text-left">Layanan</th>
                            <th class="border px-3 py-2 text-left">Karyawan</th>
                            <th class="border px-3 py-2 text-center">Status</th>
                            <th class="border px-3 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $kendaraan->firstItem() + $loop->index }}</td>
                                <td class="border px-3 py-2 text-center font-semibold whitespace-nowrap">
                                    {{ $item->nomor_antrean }}</td>
                                <td class="border px-3 py-2">{{ $item->order->pelanggan->nama }}</td>
                                <td class="border px-3 py-2">{{ $item->order->kendaraan->plat_nomor ?? '-' }}</td>
                                <td class="border px-3 py-2">{{ $item->order->layanan->nama_layanan }}</td>
                                <td class="border px-3 py-2">{{ $item->order->karyawan->nama ?? '-' }}</td>
                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    @if ($item->status == 'Menunggu')
                                        <span
                                            class="rounded-lg bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700">Menunggu</span>
                                    @elseif($item->status == 'Diproses')
                                        <span
                                            class="rounded-lg bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700">Diproses</span>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <span
                                            class="rounded-lg bg-orange-100 px-2.5 py-1 text-xs font-medium text-orange-700">Pembayaran</span>
                                    @elseif ($item->status == 'Dibatalkan')
                                        <span
                                            class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Dibatalkan</span>
                                    @else
                                        <span
                                            class="rounded-lg bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Selesai</span>
                                    @endif
                                </td>
                                <td class="border px-3 py-2 text-center w-1">
                                    @if ($item->status == 'Menunggu')
                                        <div class="flex flex-col xl:flex-row gap-1.5 justify-center items-center">
                                            <button type="button"
                                                class="btnMulai w-full xl:w-auto rounded-lg bg-blue-500 px-2.5 py-1.5 text-xs text-white hover:bg-blue-600 transition"
                                                data-modal-target="modalMulai" data-modal-toggle="modalMulai"
                                                data-antrean="{{ $item->id }}">
                                                Mulai
                                            </button>
                                            <form class="formBatalkan w-full xl:w-auto"
                                                action="{{ route('admin.antrean.batalkan', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="w-full xl:w-auto rounded-lg bg-red-500 px-2.5 py-1.5 text-xs text-white hover:bg-red-600 transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($item->status == 'Diproses')
                                        <form action="{{ route('admin.antrean.selesaiCuci', $item->id) }}" method="POST"
                                            class="formSelesai inline-block" 
                                            data-kendaraan="1">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="rounded-lg bg-green-500 px-2.5 py-1.5 text-xs text-white hover:bg-green-600 transition">
                                                Selesai Cuci
                                            </button>
                                        </form>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <button type="button" data-modal-target="modalBayar" data-modal-toggle="modalBayar"
                                            data-antrean="{{ $item->id }}" data-harga="{{ $item->order->harga }}"
                                            data-pelanggan="{{ $item->order->pelanggan->nama }}"
                                            class="btnBayar rounded-lg bg-orange-500 px-2.5 py-1.5 text-xs text-white hover:bg-orange-600 transition">
                                            Bayar
                                        </button>
                                    @else
                                        <span class="text-green-600 text-lg">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="border px-4 py-8 text-center text-gray-500">Belum ada data
                                    kendaraan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($kendaraan->hasPages())
                <div class="mt-6">
                    {{ $kendaraan->links() }}
                </div>
            @endif
        </div>

        <div id="karpet-content" class="hidden">
            <div class="overflow-x-auto rounded-lg border bg-white">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 whitespace-nowrap">
                        <tr>
                            <th class="border px-3 py-2 text-center">No</th>
                            <th class="border px-3 py-2 text-left">Pelanggan</th>
                            <th class="border px-3 py-2 text-left">Layanan</th>
                            <th class="border px-3 py-2 text-left">Karyawan</th>
                            <th class="border px-3 py-2 text-center">Status</th>
                            <th class="border px-3 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karpet as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    {{ $karpet->firstItem() + $loop->index }}</td>
                                <td class="border px-3 py-2">{{ $item->order->pelanggan->nama }}</td>
                                <td class="border px-3 py-2">{{ $item->order->layanan->nama_layanan }}</td>
                                <td class="border px-3 py-2">{{ $item->order->karyawan->nama ?? '-' }}</td>
                                <td class="border px-3 py-2 text-center whitespace-nowrap">
                                    @if ($item->status == 'Menunggu')
                                        <span
                                            class="rounded-lg bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700">Menunggu</span>
                                    @elseif($item->status == 'Diproses')
                                        <span
                                            class="rounded-lg bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700">Diproses</span>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <span
                                            class="rounded-lg bg-orange-100 px-2.5 py-1 text-xs font-medium text-orange-700">Pembayaran</span>
                                    @elseif ($item->status == 'Dibatalkan')
                                        <span
                                            class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Dibatalkan</span>
                                    @else
                                        <span
                                            class="rounded-lg bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Selesai</span>
                                    @endif
                                </td>
                                <td class="border px-3 py-2 text-center w-1 whitespace-nowrap">
                                    @if ($item->status == 'Menunggu')
                                        <div class="flex flex-col xl:flex-row gap-2 justify-center items-center">
                                            <button type="button"
                                                class="btnMulai w-full xl:w-auto rounded-lg bg-blue-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-600 transition whitespace-nowrap"
                                                data-modal-target="modalMulai" data-modal-toggle="modalMulai"
                                                data-antrean="{{ $item->id }}">
                                                <i class="fa-solid fa-play mr-1"></i> Mulai
                                            </button>
                                            <form class="formBatalkan w-full xl:w-auto"
                                                action="{{ route('admin.antrean.batalkan', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="w-full xl:w-auto rounded-lg bg-red-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-600 transition whitespace-nowrap">
                                                    <i class="fa-solid fa-xmark mr-1"></i> Batalkan
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($item->status == 'Diproses')
                                        <form action="{{ route('admin.antrean.selesaiCuci', $item->id) }}" method="POST"
                                            class="formSelesai inline-block"
                                            data-kendaraan="0">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="rounded-lg bg-green-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-green-600 transition whitespace-nowrap">
                                                Selesai Cuci
                                            </button>
                                        </form>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <button type="button" data-modal-target="modalBayar"
                                            data-modal-toggle="modalBayar" data-antrean="{{ $item->id }}"
                                            data-harga="{{ $item->order->harga }}"
                                            data-pelanggan="{{ $item->order->pelanggan->nama }}"
                                            class="btnBayar rounded-lg bg-orange-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-orange-600 transition whitespace-nowrap">
                                            Bayar
                                        </button>
                                    @else
                                        <span class="text-green-600 text-lg">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-8 text-center text-gray-500">Belum ada data
                                    karpet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($karpet->hasPages())
                <div class="mt-6">
                    {{ $karpet->links() }}
                </div>
            @endif
        </div>

        <div id="modalMulai" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
            <div class="w-full max-w-md rounded-xl bg-white shadow-2xl relative overflow-hidden">
                <div class="flex items-center justify-between border-b px-6 py-4">
                    <h3 class="text-lg font-bold text-gray-900">Mulai Pengerjaan</h3>
                    <button type="button" data-modal-hide="modalMulai"
                        class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form id="formMulai" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Pilih Karyawan</label>
                        <select name="karyawan_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-3"
                            required>
                            <option value="">Pilih Karyawan</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 border-t bg-gray-50 px-6 py-4">
                        <button type="button" data-modal-hide="modalMulai"
                            class="rounded-lg bg-white border border-gray-200 px-5 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white hover:bg-blue-700 transition flex items-center">
                            </i> Mulai Proses
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalBayar" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
            <div class="w-full max-w-3xl rounded-xl bg-white shadow-2xl relative overflow-hidden">
                <div class="flex items-center justify-between border-b px-6 py-4">
                    <h3 class="text-lg font-bold text-gray-900">Konfirmasi Pembayaran</h3>
                    <button type="button" data-modal-hide="modalBayar"
                        class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form id="formBayar" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <label
                                    class="block mb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</label>
                                <input type="text" id="namaPelanggan"
                                    class="w-full bg-transparent border-none p-0 text-gray-900 font-bold focus:ring-0 cursor-not-allowed"
                                    readonly>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Total Pembayaran</label>
                                <input type="text" id="totalBayar"
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-xl font-bold rounded-lg block w-full p-2.5 cursor-not-allowed"
                                    readonly>
                            </div>
                        </div>

                        <div class="space-y-5 md:border-l md:border-gray-100 md:pl-8">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metodePembayaran"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-3"
                                    required>
                                    <option value="">Pilih Metode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>

                            <div id="qrisSection" class="hidden flex-col items-center justify-center pt-2">
                                <div class="bg-white p-3 rounded-xl border border-gray-200 shadow-sm inline-block">
                                    <img id="qrisImage" class="h-50 w-50 object-contain rounded-lg">
                                </div>
                                <p class="mt-3 text-xs font-medium text-gray-500 text-center"><i
                                        class="fa-solid fa-qrcode mr-1"></i> Scan QRIS untuk membayar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t bg-gray-50 px-6 py-4">
                        <button type="button" data-modal-hide="modalBayar"
                            class="rounded-lg bg-white border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                        <button type="submit"
                            class="btn-konfirmasi rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 transition flex items-center shadow-sm">
                            </i> Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.querySelectorAll('.btnMulai').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.antrean;
                    document.getElementById('formMulai').action = "{{ url('admin/antrean') }}/" + id +
                        "/mulai";
                });
            });

            document.querySelectorAll('.formSelesai').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let pesan = form.dataset.kendaraan == "1" ?
                        'Pastikan kendaraan telah <b>selesai dicuci</b> dan <b>kunci kendaraan telah diterima kembali oleh admin</b>.' :
                        'Pastikan karpet telah <b>selesai dicuci</b> dan siap diserahkan kepada pelanggan.';

                    Swal.fire({
                        title: 'Konfirmasi',
                        html: pesan,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Selesai',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.formBatalkan').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Batalkan Order?',
                        text: 'Order akan dibatalkan dan tidak dapat diproses kembali.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Batalkan',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.btnBayar').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    window.antreanId = this.dataset.antrean;
                    document.getElementById('formBayar').action = "{{ url('admin/antrean') }}/" + window
                        .antreanId + "/bayar";
                    document.getElementById('namaPelanggan').value = this.dataset.pelanggan;
                    document.getElementById('totalBayar').value = "Rp " + Number(this.dataset.harga)
                        .toLocaleString('id-ID');
                    document.getElementById('metodePembayaran').value = "";
                    document.getElementById('qrisSection').classList.add('hidden');
                    document.getElementById('qrisSection').classList.remove('flex');
                });
            });

            document.getElementById('metodePembayaran').addEventListener('change', function() {
                if (this.value == "QRIS") {
                    fetch("{{ url('admin/antrean') }}/" + window.antreanId + "/qris")
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('qrisImage').src = data.image;
                            document.getElementById('qrisSection').classList.remove('hidden');
                            document.getElementById('qrisSection').classList.add('flex');
                        });
                } else {
                    document.getElementById('qrisSection').classList.add('hidden');
                    document.getElementById('qrisSection').classList.remove('flex');
                }
            });

            document.querySelectorAll('.btn-konfirmasi').forEach(button => {
                button.closest('form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi Pembayaran',
                        text: 'Apakah Anda yakin pembayaran sudah diterima?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#16a34a',
                        cancelButtonColor: '#6b7280'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });

            const tabKendaraan = document.getElementById('tab-kendaraan');
            const tabKarpet = document.getElementById('tab-karpet');
            const kendaraanContent = document.getElementById('kendaraan-content');
            const karpetContent = document.getElementById('karpet-content');

            tabKendaraan.addEventListener('click', function() {
                localStorage.setItem('tabAntrean', 'kendaraan');
                kendaraanContent.classList.remove('hidden');
                karpetContent.classList.add('hidden');
                tabKendaraan.classList.add('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKendaraan.classList.remove('text-gray-500');
                tabKarpet.classList.remove('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKarpet.classList.add('text-gray-500');
            });

            tabKarpet.addEventListener('click', function() {
                localStorage.setItem('tabAntrean', 'karpet');
                kendaraanContent.classList.add('hidden');
                karpetContent.classList.remove('hidden');
                tabKarpet.classList.add('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKarpet.classList.remove('text-gray-500');
                tabKendaraan.classList.remove('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKendaraan.classList.add('text-gray-500');
            });

            document.addEventListener('DOMContentLoaded', function() {
                const tab = localStorage.getItem('tabAntrean');
                if (tab === 'karpet') {
                    tabKarpet.click();
                } else {
                    tabKendaraan.click();
                }
            });
        </script>
    </div>
@endsection
