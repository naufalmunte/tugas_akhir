@extends('layouts.app')
@section('title', 'Tambah Kendaraan')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Tambah Kendaraan</h1>
                    <p class="text-sm text-gray-500 mt-1">Silakan scan QR pelanggan terlebih dahulu.</p>
                </div>
                <a href="{{ route('admin.kendaraan.index') }}"
                    class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="space-y-5">
                    <button type="button" id="btnScanQR"
                        class="w-full py-6 rounded-xl border-2 border-dashed border-[#5AA8D6] text-[#5AA8D6] hover:bg-[#5AA8D6] hover:text-white transition flex flex-col items-center justify-center gap-2 group">
                        <i class="fa-solid fa-qrcode text-4xl group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold text-lg">Scan QR Pelanggan</span>
                        <span class="text-xs opacity-80">Klik untuk membuka kamera</span>
                    </button>

                    <div id="cardPelanggan"
                        class="{{ $pelanggan ? '' : 'hidden' }} rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-user-check text-green-500"></i> Data Pelanggan
                        </h3>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex justify-between border-b pb-1"><span class="font-medium">Nama:</span> <span
                                    id="namaPelanggan">{{ old('pelanggan_nama', $pelanggan->nama ?? '-') }}</span>
                            </div>
                            <div class="flex justify-between border-b pb-1"><span class="font-medium">No HP:</span> <span
                                    id="hpPelanggan">{{ old('pelanggan_hp', $pelanggan->no_hp ?? '-') }}</span>
                            </div>
                            <div class="flex justify-between"><span class="font-medium">Alamat:</span> <span
                                    id="alamatPelanggan">{{ old('pelanggan_alamat', $pelanggan->alamat ?? '-') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t md:border-t-0 md:border-l border-gray-100 md:pl-8">
                    <form action="{{ route('admin.kendaraan.store') }}" method="POST" id="formKendaraan"
                        class="{{ $pelanggan ? '' : 'hidden' }} space-y-4">
                        @csrf
                        <input type="hidden" name="pelanggan_id" id="pelanggan_id"
                            value="{{ old('pelanggan_id', $pelanggan->id ?? '') }}">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5"
                                required>
                                <option value="">Pilih Jenis</option>
                                <option value="Mobil" {{ old('jenis_kendaraan') == 'Mobil' ? 'selected' : '' }}>
                                    Mobil
                                </option>

                                <option value="Motor" {{ old('jenis_kendaraan') == 'Motor' ? 'selected' : '' }}>
                                    Motor
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Plat Nomor</label>
                            <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5 uppercase"
                                placeholder="Contoh: BA 1234 XY" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Merk Kendaraan</label>
                            <input type="text" name="merk" value="{{ old('merk') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5"
                                placeholder="Contoh: Toyota Avanza" required>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="w-full md:w-auto px-6 py-2.5 bg-[#5AA8D6] text-white font-medium text-sm rounded-lg hover:bg-[#3A4163] transition focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Data
                            </button>
                        </div>
                    </form>

                    {{-- Placeholder State (Sebelum Scan) --}}
                    <div id="placeholderForm"
                        class="{{ $pelanggan ? 'hidden' : '' }} flex flex-col items-center justify-center h-full text-gray-400 py-10">
                        <i class="fa-solid fa-car text-5xl mb-3 opacity-50"></i>
                        <p class="text-sm text-center">Scan QR pelanggan di sebelah kiri<br>untuk mengisi data kendaraan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalQR"
            class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 backdrop-blur-sm transition-opacity">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-5 relative">
                <div class="flex items-center justify-between mb-4 border-b pb-3">
                    <h2 class="text-lg font-semibold text-gray-900">Scan QR Pelanggan</h2>
                    <button type="button" id="btnCloseQR"
                        class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <div id="reader" class="w-full rounded-lg overflow-hidden border border-gray-200"></div>
                <p class="text-sm text-center text-gray-500 mt-4">Arahkan kamera ke QR Code pelanggan.</p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        const modalQR = document.getElementById('modalQR');
        const btnScan = document.getElementById('btnScanQR');
        const btnClose = document.getElementById('btnCloseQR');
        const formKendaraan = document.getElementById('formKendaraan');
        const placeholderForm = document.getElementById('placeholderForm');
        let html5QrCode;

        btnScan.addEventListener('click', () => {
            modalQR.classList.remove('hidden');
            modalQR.classList.add('flex');
            html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                successScan
            );
        });

        btnClose.addEventListener('click', () => {
            if (html5QrCode) {
                html5QrCode.stop().then(() => html5QrCode.clear());
            }
            modalQR.classList.add('hidden');
            modalQR.classList.remove('flex');
        });

        function successScan(qrCodeMessage) {
            html5QrCode.stop();
            fetch("{{ route('admin.kendaraan.scanQR') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        qr_code: qrCodeMessage
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message,
                            confirmButtonColor: '#3A4163'
                        });
                        return;
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'QR Berhasil Dipindai',
                        text: 'Data pelanggan berhasil ditemukan.',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    document.getElementById('pelanggan_id').value = res.pelanggan.id;
                    document.getElementById('namaPelanggan').innerText = res.pelanggan.nama;
                    document.getElementById('hpPelanggan').innerText = res.pelanggan.no_hp;
                    document.getElementById('alamatPelanggan').innerText = res.pelanggan.alamat;

                    document.getElementById('cardPelanggan').classList.remove('hidden');
                    placeholderForm.classList.add('hidden');
                    formKendaraan.classList.remove('hidden');

                    modalQR.classList.add('hidden');
                    modalQR.classList.remove('flex');
                });
        }
    </script>
@endsection
