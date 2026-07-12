@extends('layouts.app')

@section('title','Data Karyawan')

@section('content')
<div class="rounded-xl bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="heading text-2xl font-semibold text-gray-800">Data Karyawan</h1>
            <p class="body-text text-sm text-gray-500">Kelola seluruh data karyawan.</p>
        </div>
        <div class="mb-4 flex items-center gap-3">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchKaryawan" placeholder="Cari karyawan..." class="w-72 rounded-lg border border-gray-300 py-2 pl-10 pr-4 focus:border-[#5AA8D6] focus:outline-none">
            </div>
            <a href="{{ route('admin.karyawan.create') }}" class="flex items-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-white hover:bg-[#3A4163]">
                <i class="fa-solid fa-plus"></i>
                Tambah Karyawan
            </a>
        </div>
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-3 text-center">No</th>
                    <th class="border px-4 py-3">Nama</th>
                    <th class="border px-4 py-3">Nomor HP</th>
                    <th class="border px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="karyawanTable">
                @forelse($karyawan as $item)
                <tr class="karyawan-row hover:bg-gray-50">
                    <td class="border px-4 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-3">{{ $item->nama }}</td>
                    <td class="border px-4 py-3">{{ $item->no_hp }}</td>
                    <td class="border px-4 py-3">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.karyawan.edit',$item->id) }}" class="rounded-lg bg-yellow-400 px-3 py-2 text-white hover:bg-yellow-500">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.karyawan.destroy',$item->id) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg bg-red-500 px-3 py-2 text-white hover:bg-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border px-4 py-4 text-center text-gray-500">Data karyawan belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('searchKaryawan').addEventListener('keyup',function(){
    let keyword=this.value.toLowerCase();
    document.querySelectorAll('.karyawan-row').forEach(function(row){
        row.style.display=row.innerText.toLowerCase().includes(keyword)?'':'none';
    });
});
document.querySelectorAll('.form-delete').forEach(form=>{
    form.addEventListener('submit',function(e){
        e.preventDefault();
        Swal.fire({
            title:'Hapus Data?',
            text:'Data yang dihapus tidak dapat dikembalikan.',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#dc2626',
            cancelButtonColor:'#6b7280',
            confirmButtonText:'Ya, Hapus',
            cancelButtonText:'Batal'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });
    });
});
</script>
@endsection