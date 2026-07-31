@extends('layouts.app')
@section('title', 'Tambah Order')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Tambah Order</h1>
                    <p class="text-sm text-gray-500 mt-1">Lengkapi data order layanan pelanggan.</p>
                </div>
                <a href="{{ route('admin.order.index') }}"
                    class="py-2 px-4 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.order.store') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                    <div class="md:col-span-1 space-y-5">
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                            <h3
                                class="mb-3 text-sm font-bold text-gray-800 uppercase tracking-wider flex items-center gap-2">
                                Data Pelanggan
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between border-b border-gray-200 pb-2">
                                    <span class="text-gray-500">Nama</span>
                                    <span class="font-semibold text-gray-900">{{ $pelanggan->nama }}</span>
                                </div>
                                <div class="flex justify-between pt-1">
                                    <span class="text-gray-500">No HP</span>
                                    <span class="font-semibold text-gray-900">{{ $pelanggan->no_hp }}</span>
                                </div>
                            </div>
                        </div>

                        <div id="infoAntrean" class="hidden rounded-xl border border-white-200 bg-white p-5">
                            <h3
                                class="mb-4 text-sm font-bold text-black-800 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-circle-info"></i> Info Antrean
                            </h3>

                            <div id="infoKendaraan" class="hidden space-y-3">
                                <div
                                    class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-500 shadow-sm">
                                    <span class="text-sm text-gray-600 font-medium">Sedang Diproses</span>
                                    <span
                                        class="font-bold text-black-700 bg-gray-100 px-2.5 py-0.5 rounded">{{ $sedangDiproses }}</span>
                                </div>
                                <div
                                    class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-500 shadow-sm">
                                    <span class="text-sm text-gray-600 font-medium">Menunggu</span>
                                    <span
                                        class="font-bold text-black-700 bg-gray-100 px-2.5 py-0.5 rounded">{{ $menunggu }}</span>
                                </div>
                                <div class="mt-2 pt-3 border-t border-blue-200">
                                    <p class="text-xs text-gray-500 mb-1">Total Antrean Sebelum Anda</p>
                                    <p class="font-black text-xl text-blue-800">{{ $totalAntrean }} <span
                                            class="text-sm font-medium">Kendaraan</span></p>
                                </div>
                            </div>

                            <div id="infoKarpet"
                                class="hidden bg-white p-4 rounded-lg border border-blue-100 shadow-sm text-center">
                                <i class="fa-solid fa-clock-rotate-left text-3xl text-[#5AA8D6] mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Estimasi Pengerjaan Karpet</p>
                                <p id="estimasiKarpet" class="mt-1 text-2xl font-black text-blue-800">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2 space-y-5 border-t md:border-t-0 md:border-l border-gray-100 md:pl-8">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Kategori Layanan</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-layer-group absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select name="kategori_id" id="kategori_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}" data-kendaraan="{{ $item->butuh_kendaraan }}">
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="kendaraanSection" style="display:none;">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Kendaraan</label>
                            <div class="flex gap-2">
                                <div class="relative flex-1">
                                    <i class="fa-solid fa-car absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <select name="kendaraan_id" id="kendaraan_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                        <option value="">Pilih Kendaraan</option>
                                    </select>
                                </div>
                                <button type="button" id="btnTambahKendaraan"
                                    class="hidden rounded-lg bg-[#5AA8D6] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#3A4163] transition shrink-0"
                                    title="Tambah Kendaraan Baru">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Layanan</label>
                            <div class="relative">
                                <i class="fa-solid fa-soap absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select name="layanan_id" id="layanan_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full pl-10 p-2.5">
                                    <option value="">Pilih Layanan</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-money-bill-wave absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="harga"
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm font-bold rounded-lg block w-full pl-10 p-2.5 cursor-not-allowed"
                                    readonly placeholder="Rp 0">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end">
                            <button type="submit"
                                class="w-full md:w-auto px-6 py-2.5 bg-[#5AA8D6] text-white font-medium text-sm rounded-lg hover:bg-[#3A4163] transition flex items-center justify-center">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Order
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div id="modalKendaraan"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-md rounded-xl bg-white shadow-2xl relative">
            <div class="flex items-center justify-between border-b p-4">
                <h2 class="text-lg font-semibold text-gray-900">Tambah Kendaraan Baru</h2>
                <button type="button" id="btnCloseModal"
                    class="text-gray-400 hover:text-red-500 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form id="formKendaraan">
                @csrf
                <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5"
                            required>
                            <option value="Mobil">Mobil</option>
                            <option value="Motor">Motor</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Plat Nomor</label>
                        <input type="text" name="plat_nomor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5 uppercase"
                            placeholder="Contoh: BA 1234 XY" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Merk</label>
                        <input type="text" name="merk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5AA8D6] focus:border-[#5AA8D6] block w-full p-2.5"
                            placeholder="Contoh: Toyota Avanza" required>
                    </div>
                </div>
                <div class="flex justify-end gap-3 border-t p-4">
                    <button type="button" id="btnCancelModal"
                        class="rounded-lg bg-white border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-sm font-medium text-white hover:bg-[#3A4163] transition flex items-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const pelanggan = {{ $pelanggan->id }};
        const kategori = document.getElementById('kategori_id');
        const kendaraanSection = document.getElementById('kendaraanSection');
        const kendaraan = document.getElementById('kendaraan_id');
        const layanan = document.getElementById('layanan_id');
        const btnTambah = document.getElementById('btnTambahKendaraan');
        const harga = document.getElementById('harga');
        const infoAntrean = document.getElementById('infoAntrean');
        const infoKendaraan = document.getElementById('infoKendaraan');
        const infoKarpet = document.getElementById('infoKarpet');
        const estimasiKarpet = document.getElementById('estimasiKarpet');
        const modal = document.getElementById('modalKendaraan');

        kategori.addEventListener('change', function() {
            let option = this.options[this.selectedIndex];
            let kategoriId = this.value;

            if (option.dataset.kendaraan == "1") {
                kendaraanSection.style.display = "block";

                let jenis = "";

                if (option.text.toLowerCase().includes("mobil")) {
                    jenis = "Mobil";
                } else if (option.text.toLowerCase().includes("motor")) {
                    jenis = "Motor";
                }
                fetch(
                        "{{ route('admin.order.kendaraan', 'PELANGGAN') }}"
                        .replace('PELANGGAN', pelanggan) +
                        "?jenis=" + encodeURIComponent(jenis)
                    )
                    .then(res => res.json())
                    .then(data => {
                        kendaraan.innerHTML = '<option value="">Pilih Kendaraan</option>';
                        data.forEach(function(item) {
                            kendaraan.innerHTML += `
                                <option value="${item.id}">
                                    ${item.plat_nomor} - ${item.merk}
                                </option>
                            `;
                        });
                    });
                btnTambah.classList.remove('hidden');
            } else {
                kendaraanSection.style.display = "none";
                kendaraan.innerHTML = '<option value="">Pilih Kendaraan</option>';
                btnTambah.classList.add('hidden');
            }

            fetch("{{ route('admin.order.layanan', 'KATEGORI') }}".replace('KATEGORI', kategoriId))
                .then(res => res.json())
                .then(data => {
                    layanan.innerHTML = '<option value="">Pilih Layanan</option>';
                    data.forEach(function(item) {
                        layanan.innerHTML +=
                            `<option value="${item.id}" data-harga="${item.harga}" data-estimasi="${item.estimasi_menit}">${item.nama_layanan}</option>`;
                    });
                });
        });

        layanan.addEventListener('change', function() {
            let option = this.options[this.selectedIndex];

            if (option.dataset.harga) {
                harga.value = 'Rp ' + Number(option.dataset.harga).toLocaleString('id-ID');
            } else {
                harga.value = '';
            }

            if (!kategori.value) {
                infoAntrean.classList.add('hidden');
                return;
            }

            let kategoriOption = kategori.options[kategori.selectedIndex];
            infoAntrean.classList.remove('hidden');

            if (kategoriOption.dataset.kendaraan == "1") {
                infoKendaraan.classList.remove('hidden');
                infoKarpet.classList.add('hidden');
            } else {
                infoKarpet.classList.remove('hidden');
                infoKendaraan.classList.add('hidden');
                let menit = Number(option.dataset.estimasi);
                let hari = Math.ceil(menit / 1440);
                estimasiKarpet.innerHTML = "± " + hari + " Hari";
            }
        });

        btnTambah.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        document.getElementById('btnCloseModal').addEventListener('click', closeModal);
        document.getElementById('btnCancelModal').addEventListener('click', closeModal);

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        document.getElementById('formKendaraan').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            fetch("{{ route('admin.order.kendaraan.store', $pelanggan->id) }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.success) return;

                    kendaraan.innerHTML +=
                        `<option value="${res.id}" selected>${res.plat_nomor} - ${res.merk}</option>`;
                    kendaraan.value = res.id;

                    closeModal();
                    document.getElementById('formKendaraan').reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Kendaraan berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
        });
    </script>
@endsection
