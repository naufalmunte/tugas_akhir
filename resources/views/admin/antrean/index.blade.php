@extends('layouts.app')

@section('title', 'Kelola Antrean')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Kelola Antrean</h1>
                <p class="body-text text-sm text-gray-500">Kelola proses pelayanan pelanggan.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-center">Antrean</th>
                        <th class="border px-4 py-3">Pelanggan</th>
                        <th class="border px-4 py-3">Layanan</th>
                        <th class="border px-4 py-3">Karyawan</th>
                        <th class="border px-4 py-3 text-center">Status</th>
                        <th class="border px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrean as $item)
                        <tr>
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3 text-center">{{ $item->nomor_antrean }}</td>
                            <td class="border px-4 py-3">{{ $item->order->pelanggan->nama }}</td>
                            <td class="border px-4 py-3">{{ $item->order->layanan->nama_layanan }}</td>
                            <td class="border px-4 py-3">{{ $item->order->karyawan->nama ?? '-' }}</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->status == 'Menunggu')
                                    <span class="rounded-lg bg-yellow-100 px-3 py-1 text-xs text-yellow-700">Menunggu</span>
                                @elseif($item->status == 'Diproses')
                                    <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs text-blue-700">Diproses</span>
                                @elseif($item->status == 'Menunggu Pembayaran')
                                    <span
                                        class="rounded-lg bg-orange-100 px-3 py-1 text-xs text-orange-700">Pembayaran</span>
                                @else
                                    <span class="rounded-lg bg-green-100 px-3 py-1 text-xs text-green-700">Selesai</span>
                                @endif
                            </td>
                            <td class="border px-4 py-3 text-center">

                                @if ($item->status == 'Menunggu')
                                    <button type="button" data-modal-target="modalMulai" data-modal-toggle="modalMulai"
                                        data-antrean="{{ $item->id }}"
                                        class="btnMulai rounded-lg bg-blue-500 px-3 py-2 text-white hover:bg-blue-600">
                                        Mulai
                                    </button>
                                @elseif($item->status == 'Diproses')
                                    <form action="{{ route('admin.antrean.selesaiCuci', $item->id) }}" method="POST"
                                        class="formSelesai">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="rounded-lg bg-green-500 px-3 py-2 text-white">
                                            Selesai Cuci
                                        </button>
                                    </form>
                                @elseif($item->status == 'Menunggu Pembayaran')
                                    <button type="button" data-modal-target="modalBayar" data-modal-toggle="modalBayar"
                                        data-antrean="{{ $item->id }}" data-harga="{{ $item->order->harga }}"
                                        data-pelanggan="{{ $item->order->pelanggan->nama }}"
                                        class="btnBayar rounded-lg bg-orange-500 px-3 py-2 text-white hover:bg-orange-600">
                                        Pembayaran
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
                            <td colspan="7" class="border px-4 py-5 text-center text-gray-500">
                                Belum ada antrean.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalMulai" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-full w-full overflow-y-auto overflow-x-hidden bg-black/50">
        <div class="relative mx-auto mt-24 w-full max-w-md">
            <div class="rounded-lg bg-white shadow">
                <div class="flex items-center justify-between border-b p-4">
                    <h3 class="text-lg font-semibold">
                        Mulai Pengerjaan
                    </h3>
                    <button type="button" data-modal-hide="modalMulai">
                        ✕
                    </button>
                </div>

                <form id="formMulai" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-5">

                        <label class="form-label">
                            Pilih Karyawan
                        </label>

                        <select name="karyawan_id" class="form-input" required>

                            <option value="">
                                -- Pilih Karyawan --
                            </option>

                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="flex justify-end gap-3 border-t p-4">

                        <button type="button" data-modal-hide="modalMulai" class="rounded-lg bg-gray-300 px-4 py-2">

                            Batal

                        </button>

                        <button class="rounded-lg bg-blue-500 px-4 py-2 text-white">

                            Mulai

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
    <div id="modalBayar" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-full w-full overflow-y-auto overflow-x-hidden bg-black/50">
        <div class="relative mx-auto mt-24 w-full max-w-md">
            <div class="rounded-lg bg-white shadow">
                <div class="flex items-center justify-between border-b p-4">
                    <h3 class="text-lg font-semibold">Pembayaran</h3>
                    <button type="button" data-modal-hide="modalBayar">✕</button>
                </div>
                <form id="formBayar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="form-label">Pelanggan</label>
                            <input type="text" id="namaPelanggan" class="form-input bg-gray-100" readonly>
                        </div>
                        <div>
                            <label class="form-label">Total Pembayaran</label>
                            <input type="text" id="totalBayar" class="form-input bg-gray-100" readonly>
                        </div>
                        <div>
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metodePembayaran" class="form-input" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="Cash">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div id="qrisSection" class="hidden text-center mt-4">
                            <img id="qrisImage" class="mx-auto border rounded-lg p-2">
                            <p class="mt-3 text-sm text-gray-500">
                                Silakan scan QRIS untuk melakukan pembayaran.
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t p-4">
                        <button type="button" data-modal-hide="modalBayar" class="rounded-lg bg-gray-300 px-4 py-2">
                            Batal
                        </button>
                        <button class="rounded-lg bg-green-600 px-4 py-2 text-white">
                            Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('formMulai');

            document.querySelectorAll('.btnMulai').forEach(function(btn) {

                btn.addEventListener('click', function() {

                    const id = this.dataset.antrean;

                    form.action = "{{ url('admin/antrean') }}/" + id + "/mulai";

                    console.log(form.action);

                });

            });

        });

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

        document.querySelectorAll('.btnBayar').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let id = this.dataset.antrean;
                let pelanggan = this.dataset.pelanggan;
                let harga = this.dataset.harga;
                document.getElementById('formBayar').action = "{{ url('admin/antrean') }}/" + id +
                    "/bayar";
                document.getElementById('namaPelanggan').value = pelanggan;
                document.getElementById('totalBayar').value = "Rp " + Number(harga).toLocaleString('id-ID');
                document.getElementById('metodePembayaran').value = "";
                document.getElementById('qrisSection').classList.add('hidden');
            });
        });
        document.getElementById('metodePembayaran').addEventListener('change', function() {
            if (this.value == "QRIS") {
                document.getElementById('qrisSection').classList.remove('hidden');
            } else {
                document.getElementById('qrisSection').classList.add('hidden');
            }
        });

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

        document.querySelectorAll('.btnBayar').forEach(function(btn) {

            btn.addEventListener('click', function() {

                window.antreanId = this.dataset.antrean;

                document.getElementById('formBayar').action =
                    "{{ url('admin/antrean') }}/" + window.antreanId + "/bayar";

                document.getElementById('namaPelanggan').value = this.dataset.pelanggan;

                document.getElementById('totalBayar').value =
                    "Rp " + Number(this.dataset.harga).toLocaleString('id-ID');

                document.getElementById('qrisSection').classList.add('hidden');

                document.getElementById('metodePembayaran').value = "";

            });

        });
    </script>
@endsection
