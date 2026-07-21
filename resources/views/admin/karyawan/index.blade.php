@extends('layouts.app')
@section('title', 'Data Karyawan')

@section('content')
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <!-- Header: flex-col di HP, flex-row di Desktop -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="heading text-2xl font-semibold text-gray-800">Data Karyawan</h1>
                <p class="body-text text-sm text-gray-500">Kelola seluruh data karyawan.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <div class="relative w-full sm:w-auto">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchKaryawan" placeholder="Cari karyawan..."
                        class="w-full sm:w-72 rounded-lg border border-gray-300 py-2 pl-10 pr-4 focus:border-[#5AA8D6] focus:outline-none">
                </div>
                <a href="{{ route('admin.karyawan.create') }}"
                    class="flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white transition hover:bg-[#3A4163]">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Karyawan</span>
                </a>
            </div>
        </div>

        <!-- Tabel diselaraskan gayanya -->
        <div class="overflow-x-auto rounded-lg border bg-white">
            <table class="min-w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">No</th>
                        <th class="border px-4 py-3 text-left">Nama</th>
                        <th class="border px-4 py-3 text-left">Nomor HP</th>
                        <th class="border px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="karyawanTable">
                    @forelse($karyawan as $item)
                        <tr class="karyawan-row hover:bg-gray-50">
                            <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-3 font-medium text-gray-800">{{ $item->nama }}</td>
                            <td class="border px-4 py-3 text-gray-600">{{ $item->no_hp }}</td>
                            <td class="border px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.karyawan.edit', $item->id) }}"
                                        class="rounded-lg bg-yellow-400 px-3 py-2 text-white transition hover:bg-yellow-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.karyawan.destroy', $item->id) }}" method="POST"
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
                            <td colspan="4" class="border px-4 py-8 text-center text-gray-500">Data karyawan belum
                                tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('searchKaryawan').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            document.querySelectorAll('.karyawan-row').forEach(function(row) {
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
