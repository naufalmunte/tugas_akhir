@extends('layouts.app')

@section('title', 'Data Order')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Order</h1>
                <p class="body-text mt-1 text-sm text-gray-500">Daftar seluruh transaksi layanan.</p>
            </div>

            <button type="button" id="btnScan" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                <i class="fa-solid fa-qrcode mr-2"></i>
                Scan QR Member
            </button>

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
                        <th class="border px-4 py-3 text-end">Harga</th>
                        <th class="border px-4 py-3 text-center">Status</th>
                        <th class="border px-4 py-3 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                {{ $item->antrean->nomor_antrean ?? '-' }}
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
                            <td class="border px-4 py-3 text-end">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->antrean)
                                    @switch($item->antrean->status)
                                        @case('Menunggu')
                                            <span class="rounded-lg bg-yellow-100 px-3 py-1 text-xs text-yellow-700">
                                                Menunggu
                                            </span>
                                        @break

                                        @case('Diproses')
                                            <span class="rounded-lg bg-blue-100 px-3 py-1 text-xs text-blue-700">
                                                Diproses
                                            </span>
                                        @break

                                        @case('Menunggu Pembayaran')
                                            <span class="rounded-lg bg-orange-100 px-3 py-1 text-xs text-orange-700">
                                                Menunggu Pembayaran
                                            </span>
                                        @break

                                        @case('Selesai')
                                            <span class="rounded-lg bg-green-100 px-3 py-1 text-xs text-green-700">
                                                Selesai
                                            </span>
                                        @break
                                    @endswitch
                                @endif
                            </td>
                            <td class="border px-4 py-3 text-center">
                                {{ $item->created_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="border px-4 py-5 text-center text-gray-500">
                                    Belum ada data order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL SCANNER --}}
        <div id="modalScanner" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">
            <div class="w-full max-w-xl rounded-xl bg-white p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold">
                        Scan QR Member
                    </h2>
                    <button id="btnCloseScanner" class="text-xl">
                        ✕
                    </button>
                </div>
                <div id="reader" class="rounded-lg border"></div>
                <p class="mt-4 text-center text-sm text-gray-500">
                    Arahkan kamera ke QR Code Member.
                </p>
            </div>
        </div>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            let scanner;
            const modal = document.getElementById('modalScanner');
            document.getElementById('btnScan').addEventListener('click', function() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                scanner = new Html5Qrcode("reader");
                scanner.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    success,
                    error
                );
            });
            document.getElementById('btnCloseScanner').addEventListener('click', function() {
                stopScanner();
            });

            function success(decodedText) {
                stopScanner();
                fetch("/admin/order/pelanggan/" + decodedText)
                    .then(res => res.json())
                    .then(res => {
                        if (!res.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'QR Tidak Terdaftar'
                            });
                            return;
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Member Ditemukan',
                            text: 'Mengalihkan ke halaman order...',
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            fetch("{{ route('admin.order.scan') }}", {

                                    method: "POST",

                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },

                                    body: JSON.stringify({

                                        pelanggan_id: res.data.id

                                    })

                                })

                                .then(res => res.json())

                                .then(data => {

                                    if (data.success) {

                                        window.location.href = data.redirect;

                                    }

                                });
                        }, 1200);
                    });
            }

            function error(err) {}

            function stopScanner() {
                if (scanner) {
                    scanner.stop().then(() => {
                        scanner.clear();
                    });
                }
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        </script>
    @endsection
