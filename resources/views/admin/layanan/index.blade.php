@extends('layouts.app')
@section('title', 'Data Layanan')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Layanan</h1>
                <p class="body-text text-sm text-gray-500">Kelola seluruh data layanan.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <form id="formSearch" method="GET">
                    <div class="relative">
                        <input id="search" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari layanan..."
                            class="w-full sm:w-80 rounded-lg border border-gray-300 pl-10 pr-4 py-2 focus:ring-[#5AA8D6] focus:border-[#5AA8D6]">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
                <a href="{{ route('admin.layanan.create') }}"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm whitespace-nowrap">
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
                            <td class="border px-4 py-3 text-center">{{ $layanan->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->kategori->nama_kategori }}</td>
                            <td class="border px-4 py-3 font-medium text-gray-800">{{ $item->nama_layanan }}</td>
                            <td class="border px-4 py-3 text-center font-semibold text-gray-800">Rp
                                {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-3 text-center text-gray-600">{{ $item->estimasi_menit }} Menit</td>
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
                                        class="rounded-lg bg-yellow-400 px-3 py-2 text-white transition hover:bg-yellow-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST"
                                        class="form-delete inline-block">
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
                        <tr>
                            <td colspan="7" class="border px-4 py-8 text-center text-gray-500">Data layanan belum
                                tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($layanan->hasPages())
            <div class="mt-6">
                {{ $layanan->links() }}
            </div>
        @endif
    </div>

    <script>
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

        const search = document.getElementById('search');
        const form = document.getElementById('formSearch');
        let timeout;
        search.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                form.submit();
            }, 200);
        });
    </script>
@endsection
