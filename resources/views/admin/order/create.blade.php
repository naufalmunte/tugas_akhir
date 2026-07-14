@extends('layouts.app')

@section('title', 'Tambah Order')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Order</h1>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data order pelanggan.</p>
        </div>

        <form action="{{ route('admin.order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2 rounded-lg border bg-gray-50 p-4">

                    <h3 class="mb-4 text-lg font-semibold">
                        Data Pelanggan
                    </h3>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        <div>

                            <label class="form-label">
                                Nama
                            </label>

                            <input class="form-input bg-gray-100" value="{{ $pelanggan->nama }}" readonly>

                        </div>

                        <div>

                            <label class="form-label">
                                No HP
                            </label>

                            <input class="form-input bg-gray-100" value="{{ $pelanggan->no_hp }}" readonly>

                        </div>

                    </div>

                </div>

                {{-- Kategori --}}
                <div>
                    <label class="form-label">Kategori Layanan</label>
                    <select name="kategori_id" id="kategori_id" class="form-input">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" data-kendaraan="{{ $item->butuh_kendaraan }}">
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Kendaraan --}}
                <div id="kendaraanSection" style="display:none;">
                    <label class="form-label">Kendaraan</label>

                    <select name="kendaraan_id" id="kendaraan_id" class="form-input">
                        <option value="">-- Pilih Kendaraan --</option>
                    </select>

                    <button type="button" id="btnTambahKendaraan"
                        class="hidden mt-3 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">

                        <i class="fa-solid fa-plus mr-2"></i>
                        Tambah Kendaraan

                    </button>

                </div>

                {{-- Layanan --}}
                <div class="md:col-span-2">
                    <label class="form-label">Layanan</label>

                    <select name="layanan_id" id="layanan_id" class="form-input">
                        <option value="">-- Pilih Layanan --</option>
                    </select>

                </div>

                {{-- Harga --}}
                <div>
                    <label class="form-label">Harga</label>

                    <input type="text" id="harga" class="form-input bg-gray-100" readonly>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('admin.order.index') }}" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-400">
                    Batal
                </a>

                <button type="submit" class="rounded-lg bg-[#5AA8D6] px-5 py-2 text-white hover:bg-[#3A4163]">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Order
                </button>

            </div>

        </form>
    </div>
    <div id="modalKendaraan" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

        <div class="w-full max-w-lg rounded-xl bg-white p-6">

            <h2 class="mb-5 text-xl font-semibold">
                Tambah Kendaraan
            </h2>

            <form id="formKendaraan">

                @csrf

                <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">

                <div class="space-y-4">

                    <div>

                        <label class="form-label">
                            Jenis Kendaraan
                        </label>

                        <select name="jenis_kendaraan" class="form-input" required>

                            <option value="Mobil">
                                Mobil
                            </option>

                            <option value="Motor">
                                Motor
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="form-label">
                            Plat Nomor
                        </label>

                        <input type="text" name="plat_nomor" class="form-input" required>

                    </div>

                    <div>

                        <label class="form-label">
                            Merk
                        </label>

                        <input type="text" name="merk" class="form-input" required>

                    </div>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <button type="button" id="btnCloseModal" class="rounded-lg bg-gray-300 px-4 py-2">

                        Batal

                    </button>

                    <button type="submit" class="rounded-lg bg-[#5AA8D6] px-4 py-2 text-white">
                        Simpan
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
        kategori.addEventListener('change', function() {

            let option = this.options[this.selectedIndex];
            let kategoriId = this.value;

            if (option.dataset.kendaraan == "1") {

                kendaraanSection.style.display = "block";

                fetch("{{ route('admin.order.kendaraan', 'PELANGGAN') }}".replace('PELANGGAN', pelanggan))
                    .then(res => res.json())
                    .then(data => {

                        kendaraan.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';

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
                kendaraan.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';
                btnTambah.classList.add('hidden');

            }

            fetch("{{ route('admin.order.layanan', 'KATEGORI') }}".replace('KATEGORI', kategoriId))
                .then(res => res.json())
                .then(data => {

                    layanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';

                    data.forEach(function(item) {

                        layanan.innerHTML += `
                <option value="${item.id}" data-harga="${item.harga}">
                    ${item.nama_layanan}
                </option>
            `;

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

        });

        const modal = document.getElementById('modalKendaraan');

        btnTambah.addEventListener('click', function() {

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        });

        document.getElementById('btnCloseModal').addEventListener('click', function() {

            modal.classList.remove('flex');
            modal.classList.add('hidden');

        });

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

                    if (!res.success) {
                        return;
                    }

                    kendaraan.innerHTML += `
            <option value="${res.id}" selected>
                ${res.plat_nomor} - ${res.merk}
            </option>
        `;

                    kendaraan.value = res.id;

                    modal.classList.remove('flex');
                    modal.classList.add('hidden');

                    document.getElementById('formKendaraan').reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Kendaraan berhasil ditambahkan',
                        timer: 1200,
                        showConfirmButton: false
                    });

                });

        });
    </script>

@endsection
