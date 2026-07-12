@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Pelanggan</h1>
                <p class="body-text text-sm text-gray-500">Kelola seluruh data pelanggan.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchPelanggan" placeholder="Cari pelanggan..."
                        class="w-72 rounded-lg border border-gray-300 py-2 pl-10 pr-4 focus:border-[#5AA8D6] focus:outline-none">
                </div>

                <a href="{{ route('admin.pelanggan.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#5AA8D6] px-2 py-2 text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Pelanggan</span>
                </a>
            </div>
        </div>

        <div class="rounded-xl bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Nama</th>
                            <th class="px-6 py-3 text-left">No HP</th>
                            <th class="px-6 py-3 text-left">Alamat</th>
                            <th class="px-6 py-3 text-center">QR Code</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="pelangganTable">
                        @forelse($pelanggan as $item)
                            <tr class="pelanggan-row border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $item->nama }}</td>
                                <td class="px-6 py-4">{{ $item->no_hp }}</td>
                                <td class="px-6 py-4">{{ $item->alamat }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->qr_code_path)
                                        <button type="button"
                                            onclick="showQr('{{ asset('storage/' . $item->qr_code_path) }}','{{ $item->nama }}','{{ $item->no_hp }}')"
                                            class="mx-auto">
                                            <img src="{{ asset('storage/' . $item->qr_code_path) }}"
                                                class="h-14 w-14 rounded border hover:scale-110 transition">
                                        </button>
                                    @else
                                        <span class="text-gray-400">Belum Ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.pelanggan.edit', $item->id) }}"
                                            class="rounded-lg bg-yellow-400 px-3 py-2 text-white transition hover:bg-yellow-500">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.pelanggan.destroy', $item->id) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg bg-red-500 px-3 py-2 text-white transition hover:bg-red-600">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="pelanggan-row">
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada data pelanggan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="qrModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="w-full max-w-md rounded-xl bg-white p-6">
            <h2 class="heading mb-5 text-xl font-semibold text-center">QR Code Pelanggan</h2>

            <img id="modalQrImage" class="mx-auto h-64 w-64">

            <div class="mt-4 space-y-1 text-center">
                <h3 id="modalNama" class="font-semibold text-lg"></h3>
                <p id="modalHp" class="text-gray-500"></p>
            </div>

            <div class="mt-6 flex justify-center gap-3">
                <a id="downloadQr" href="#" download
                    class="inline-flex items-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-download"></i>
                    Download QR
                </a>
                <a id="waButton" href="#" target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">
                    <i class="fa-brands fa-whatsapp"></i>
                    Kirim WA
                </a>
            </div>

            <button onclick="closeQr()" class="mt-6 w-full rounded-lg bg-gray-200 py-2 hover:bg-gray-300">
                Tutup
            </button>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Data?',
                    text: 'Data pelanggan beserta QR Code akan dihapus.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        document.getElementById('searchPelanggan').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();

            document.querySelectorAll('.pelanggan-row').forEach(function(row) {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });

        function showQr(image, nama, hp) {
            document.getElementById('modalQrImage').src = image;
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalHp').innerText = hp;

            document.getElementById('downloadQr').href = image;

            let nomor = hp.replace(/^0/, '62');

            let pesan = `Halo Bapak/Ibu ${nama},

Terima kasih telah menggunakan layanan Door Smeer 24 Jam.

QR Code pelanggan Anda telah berhasil dibuat.

Silakan unduh QR Code melalui sistem dan lampirkan pada chat ini agar dapat disimpan dan digunakan saat melakukan layanan berikutnya.

Terima kasih.`;

            document.getElementById('waButton').href = `https://wa.me/${nomor}?text=${encodeURIComponent(pesan)}`;

            document.getElementById('qrModal').classList.remove('hidden');
            document.getElementById('qrModal').classList.add('flex');
        }

        function closeQr() {
            document.getElementById('qrModal').classList.remove('flex');
            document.getElementById('qrModal').classList.add('hidden');
        }
    </script>
@endsection
