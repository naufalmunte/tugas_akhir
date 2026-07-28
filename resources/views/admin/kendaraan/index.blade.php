@extends('layouts.app')
@section('title', 'Data Kendaraan')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Kendaraan</h1>
                <p class="body-text text-sm text-gray-500">Kelola seluruh data kendaraan pelanggan.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <form method="GET">

                    <div class="relative">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari pelanggan, plat atau merk..."
                            class="w-full sm:w-80 rounded-lg border border-gray-300 pl-10 pr-4 py-2 focus:ring-[#5AA8D6] focus:border-[#5AA8D6]">

                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>

                    </div>

                </form>

                <a href="{{ route('admin.kendaraan.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#5AA8D6] hover:bg-[#4a97c3] text-white rounded-lg transition whitespace-nowrap">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Tambah Kendaraan
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-left">Pelanggan</th>
                        <th class="border px-4 py-3 text-center">Jenis</th>
                        <th class="border px-4 py-3 text-center">Plat Nomor</th>
                        <th class="border px-4 py-3 text-left">Merk</th>
                        <th class="border px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kendaraanTable">
                    @forelse($kendaraan as $item)
                        <tr class="kendaraan-row hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $kendaraan->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-3">
                                <div class="font-medium text-gray-800">{{ $item->pelanggan->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $item->pelanggan->no_hp }}</div>
                            </td>
                            <td class="border px-4 py-3 text-center text-gray-600">{{ $item->jenis_kendaraan }}</td>
                            <td class="border px-4 py-3 text-center font-semibold text-gray-700">{{ $item->plat_nomor }}
                            </td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->merk }}</td>
                            <td class="border px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.kendaraan.edit', $item->id) }}"
                                        class="rounded-lg bg-yellow-400 px-3 py-2 text-white transition hover:bg-yellow-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.kendaraan.destroy', $item->id) }}" method="POST"
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
                            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">Data kendaraan belum
                                tersedia.</td>
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

        const search = document.querySelector('input[name="search"]');

        let timeout;

        search.addEventListener('keyup', function() {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                this.form.submit();

            }, 200);

        });
    </script>
@endsection
