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

        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

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
                <table class="min-w-full text-sm whitespace-nowrap">
                    <thead class="bg-gray-100">
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
                                <td class="border px-4 py-3 text-center">{{ $kendaraan->firstItem() + $loop->index }}</td>
                                <td class="border px-4 py-3 text-center font-semibold">{{ $item->nomor_antrean }}</td>
                                <td class="border px-4 py-3">{{ $item->order->pelanggan->nama }}</td>
                                <td class="border px-4 py-3">{{ $item->order->kendaraan->plat_nomor ?? '-' }}</td>
                                <td class="border px-4 py-3">{{ $item->order->layanan->nama_layanan }}</td>
                                <td class="border px-4 py-3">{{ $item->order->karyawan->nama ?? '-' }}</td>
                                <td class="border px-4 py-3 text-center">
                                    @if ($item->status == 'Menunggu')
                                        <span
                                            class="rounded-lg bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">Menunggu</span>
                                    @elseif($item->status == 'Diproses')
                                        <span
                                            class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">Diproses</span>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <span
                                            class="rounded-lg bg-orange-100 px-3 py-1 text-xs font-medium text-orange-700">Pembayaran</span>
                                    @elseif ($item->status == 'Dibatalkan')
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span
                                            class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Selesai</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-3 text-center">
                                    @if ($item->status == 'Menunggu')
                                        <div class="flex gap-2">

                                            <button type="button"
                                                class="btnMulai rounded-lg bg-blue-500 px-3 py-2 text-white hover:bg-blue-600"
                                                data-modal-target="modalMulai" data-modal-toggle="modalMulai"
                                                data-antrean="{{ $item->id }}">

                                                <i class="fa-solid fa-play mr-1"></i>
                                                Mulai

                                            </button>

                                            <form class="formBatalkan"
                                                action="{{ route('admin.antrean.batalkan', $item->id) }}" method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600">

                                                    <i class="fa-solid fa-xmark mr-1"></i>
                                                    Batalkan

                                                </button>

                                            </form>

                                        </div>
                                    @elseif($item->status == 'Diproses')
                                        <form action="{{ route('admin.antrean.selesaiCuci', $item->id) }}" method="POST"
                                            class="formSelesai inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="rounded-lg bg-green-500 px-3 py-1.5 text-white hover:bg-green-600">Selesai
                                                Cuci</button>
                                        </form>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <button type="button" data-modal-target="modalBayar" data-modal-toggle="modalBayar"
                                            data-antrean="{{ $item->id }}" data-harga="{{ $item->order->harga }}"
                                            data-pelanggan="{{ $item->order->pelanggan->nama }}"
                                            class="btnBayar rounded-lg bg-orange-500 px-3 py-1.5 text-white hover:bg-orange-600">
                                            Bayar
                                        </button>
                                    @else
                                        <span class="text-green-600">
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

        {{-- TAB KARPET (Part 2) --}}
        <div id="karpet-content" class="hidden">
            <div class="overflow-x-auto rounded-lg border bg-white">
                <table class="min-w-full text-sm whitespace-nowrap">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-3 text-center">No</th>
                            <th class="border px-4 py-3 text-left">Pelanggan</th>
                            <th class="border px-4 py-3 text-left">Layanan</th>
                            <th class="border px-4 py-3 text-left">Karyawan</th>
                            <th class="border px-4 py-3 text-center">Status</th>
                            <th class="border px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karpet as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-3 text-center">{{ $karpet->firstItem() + $loop->index }}</td>
                                <td class="border px-4 py-3">{{ $item->order->pelanggan->nama }}</td>
                                <td class="border px-4 py-3">{{ $item->order->layanan->nama_layanan }}</td>
                                <td class="border px-4 py-3">{{ $item->order->karyawan->nama ?? '-' }}</td>
                                <td class="border px-4 py-3 text-center">
                                    @if ($item->status == 'Menunggu')
                                        <span
                                            class="rounded-lg bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">Menunggu</span>
                                    @elseif($item->status == 'Diproses')
                                        <span
                                            class="rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">Diproses</span>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <span
                                            class="rounded-lg bg-orange-100 px-3 py-1 text-xs font-medium text-orange-700">Pembayaran</span>
                                    @elseif ($item->status == 'Dibatalkan')
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span
                                            class="rounded-lg bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Selesai</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-3 text-center">
                                    @if ($item->status == 'Menunggu')
                                        <div class="flex gap-2">

                                            <button type="button"
                                                class="btnMulai rounded-lg bg-blue-500 px-3 py-2 text-white hover:bg-blue-600"
                                                data-modal-target="modalMulai" data-modal-toggle="modalMulai"
                                                data-antrean="{{ $item->id }}">

                                                <i class="fa-solid fa-play mr-1"></i>
                                                Mulai

                                            </button>

                                            <form class="formBatalkan"
                                                action="{{ route('admin.antrean.batalkan', $item->id) }}" method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                    class="rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600">

                                                    <i class="fa-solid fa-xmark mr-1"></i>
                                                    Batalkan

                                                </button>

                                            </form>

                                        </div>
                                    @elseif($item->status == 'Diproses')
                                        <form action="{{ route('admin.antrean.selesaiCuci', $item->id) }}" method="POST"
                                            class="formSelesai inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="rounded-lg bg-green-500 px-3 py-1.5 text-white hover:bg-green-600">Selesai
                                                Cuci</button>
                                        </form>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <button type="button" data-modal-target="modalBayar"
                                            data-modal-toggle="modalBayar" data-antrean="{{ $item->id }}"
                                            data-harga="{{ $item->order->harga }}"
                                            data-pelanggan="{{ $item->order->pelanggan->nama }}"
                                            class="btnBayar rounded-lg bg-orange-500 px-3 py-1.5 text-white hover:bg-orange-600">
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

        <!-- Modal Mulai Pengerjaan -->
        <div id="modalMulai" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
            <div class="w-full max-w-md max-h-[90vh] overflow-y-auto rounded-xl bg-white shadow-2xl relative">
                <div class="flex items-center justify-between border-b p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Mulai Pengerjaan</h3>
                    <button type="button" data-modal-hide="modalMulai"
                        class="text-gray-400 hover:text-gray-700 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form id="formMulai" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-5">
                        <label class="form-label block mb-1 text-sm font-medium text-gray-700">Pilih Karyawan</label>
                        <select name="karyawan_id"
                            class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                            required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-3 border-t p-4">
                        <button type="button" data-modal-hide="modalMulai"
                            class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 transition">Mulai</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Pembayaran -->
        <div id="modalBayar" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
            <div class="w-full max-w-md max-h-[90vh] overflow-y-auto rounded-xl bg-white shadow-2xl relative">
                <div class="flex items-center justify-between border-b p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Pembayaran</h3>
                    <button type="button" data-modal-hide="modalBayar"
                        class="text-gray-400 hover:text-gray-700 transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form id="formBayar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="form-label block mb-1 text-sm font-medium text-gray-700">Pelanggan</label>
                            <input type="text" id="namaPelanggan"
                                class="form-input w-full rounded-lg border-gray-200 bg-gray-100 cursor-not-allowed"
                                readonly>
                        </div>
                        <div>
                            <label class="form-label block mb-1 text-sm font-medium text-gray-700">Total Pembayaran</label>
                            <input type="text" id="totalBayar"
                                class="form-input w-full rounded-lg border-gray-200 bg-gray-100 font-semibold text-gray-800 cursor-not-allowed"
                                readonly>
                        </div>
                        <div>
                            <label class="form-label block mb-1 text-sm font-medium text-gray-700">Metode
                                Pembayaran</label>
                            <select name="metode_pembayaran" id="metodePembayaran"
                                class="form-input w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200"
                                required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="Cash">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div id="qrisSection" class="hidden text-center mt-4">
                            <div
                                class="bg-gray-50 p-3 rounded-xl border border-gray-100 inline-block mx-auto flex justify-center">
                                <img id="qrisImage" class="h-48 w-48 object-contain rounded-lg">
                            </div>
                            <p class="mt-3 text-sm text-gray-500">Silakan scan QRIS untuk melakukan pembayaran.</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t p-4">
                        <button type="button" data-modal-hide="modalBayar"
                            class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 transition">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Set form action untuk Modal Mulai
            document.querySelectorAll('.btnMulai').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.antrean;
                    document.getElementById('formMulai').action = "{{ url('admin/antrean') }}/" + id +
                        "/mulai";
                });
            });

            // SweetAlert Konfirmasi Selesai Cuci
            document.querySelectorAll('.formSelesai').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi',
                        html: 'Pastikan kendaraan telah <b>selesai dicuci</b> dan <b>kunci kendaraan telah diterima kembali oleh admin</b>.',
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

            // Gabungan fungsi untuk Modal Pembayaran
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
                });
            });

            // Fetch QRIS image ketika pilih metode QRIS
            document.getElementById('metodePembayaran').addEventListener('change', function() {
                if (this.value == "QRIS") {
                    fetch("{{ url('admin/antrean') }}/" + window.antreanId + "/qris")
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('qrisImage').src = data.image;
                            document.getElementById('qrisSection').classList.remove('hidden');
                        });
                } else {
                    document.getElementById('qrisSection').classList.add('hidden');
                }
            });

            const tabKendaraan = document.getElementById('tab-kendaraan');
            const tabKarpet = document.getElementById('tab-karpet');
            const kendaraanContent = document.getElementById('kendaraan-content');
            const karpetContent = document.getElementById('karpet-content');

            tabKendaraan.addEventListener('click', function() {
                kendaraanContent.classList.remove('hidden');
                karpetContent.classList.add('hidden');
                tabKendaraan.classList.add('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKendaraan.classList.remove('text-gray-500');
                tabKarpet.classList.remove('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKarpet.classList.add('text-gray-500');
            });

            tabKarpet.addEventListener('click', function() {
                kendaraanContent.classList.add('hidden');
                karpetContent.classList.remove('hidden');
                tabKarpet.classList.add('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKarpet.classList.remove('text-gray-500');
                tabKendaraan.classList.remove('border-b-2', 'border-[#5AA8D6]', 'text-[#5AA8D6]');
                tabKendaraan.classList.add('text-gray-500');
            });
        </script>
    </div>
@endsection
