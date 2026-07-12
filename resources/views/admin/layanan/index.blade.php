@extends('layouts.app')

@section('title', 'Data Layanan')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Layanan</h1>
                <p class="body-text text-sm text-gray-500">Kelola seluruh data layanan.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchLayanan" placeholder="Cari layanan..."
                        class="w-72 rounded-lg border border-gray-300 py-2 pl-10 pr-4 focus:border-[#5AA8D6] focus:outline-none">
                </div>

                <a href="{{ route('admin.layanan.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-left">Kategori</th>
                        <th class="border px-4 py-3 text-left">Nama Layanan</th>
                        <th class="border px-4 py-3 text-center">Harga</th>
                        <th class="border px-4 py-3 text-center">Estimasi</th>
                        <th class="border px-4 py-3 text-center">Status</th>
                        <th class="border px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="layananTable">
                    @forelse($layanan as $item)
                        <tr class="layanan-row hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3">{{ $item->kategori->nama_kategori }}</td>
                            <td class="border px-4 py-3">{{ $item->nama_layanan }}</td>
                            <td class="border px-4 py-3 text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-3 text-center">{{ $item->estimasi_menit }} Menit</td>
                            <td class="border px-4 py-3 text-center">
                                @if ($item->status == 'aktif')
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        <i class="fa-solid fa-circle mr-1 text-[8px]"></i>Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        <i class="fa-solid fa-circle mr-1 text-[8px]"></i>Nonaktif
                                    </span>
                                @endif
                                
                            </td>
                            <td class="border px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.layanan.edit', $item->id) }}"
                                        class="rounded-lg bg-yellow-400 px-3 py-2 text-white hover:bg-yellow-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border px-4 py-5 text-center text-gray-500">Data layanan belum
                                tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('searchLayanan').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            document.querySelectorAll('.layanan-row').forEach(function(row) {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });

        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Data?',
                    text: 'Data yang dihapus tidak dapat dikembalikan.',
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
    </script>
@endsection
