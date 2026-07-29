<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $search=$request->search;

        $layanan=Layanan::with('kategori')
            ->when($search,function($query) use($search){
                $query->where('nama_layanan','like',"%{$search}%")
                    ->orWhereHas('kategori',function($q) use($search){
                        $q->where('nama_kategori','like',"%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.layanan.index',compact('layanan'));
    }

    public function create()
    {
        $kategori=KategoriLayanan::orderBy('nama_kategori')->get();
        return view('admin.layanan.create',compact('kategori'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_layanan_id'=>'required|exists:kategori_layanan,id',
            'nama_layanan'=>'required|max:100|unique:layanan,nama_layanan,NULL,id,kategori_layanan_id,'.$request->kategori_layanan_id,
            'harga'=>'required|numeric|min:0',
            'estimasi_menit'=>'required|integer|min:1',
            'deskripsi'=>'nullable',
            'status'=>'required|in:aktif,nonaktif'
        ],
        [
            'kategori_layanan_id.required'=>'Kategori layanan harus dipilih.',
            'nama_layanan.required'=>'Nama layanan harus diisi.',
            'nama_layanan.unique'=>'Nama layanan sudah ada.',
            'harga.required'=>'Harga layanan harus diisi.',
            'estimasi_menit.required'=>'Estimasi menit layanan harus diisi.',
            'status.required'=>'Status layanan harus dipilih.'
        ]
        );

        Layanan::create([
            'kategori_layanan_id'=>$request->kategori_layanan_id,
            'nama_layanan'=>$request->nama_layanan,
            'harga'=>$request->harga,
            'estimasi_menit'=>$request->estimasi_menit,
            'deskripsi'=>$request->deskripsi,
            'status'=>$request->status
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success','Data layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $layanan=Layanan::findOrFail($id);
        $kategori=KategoriLayanan::orderBy('nama_kategori')->get();

        return view('admin.layanan.edit',compact('layanan','kategori'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'kategori_layanan_id'=>'required|exists:kategori_layanan,id',
            'nama_layanan'=>'required|max:100|unique:layanan,nama_layanan,'.$id.',id,kategori_layanan_id,'.$request->kategori_layanan_id,
            'harga'=>'required|numeric|min:0',
            'estimasi_menit'=>'required|integer|min:1',
            'deskripsi'=>'nullable',
            'status'=>'required|in:aktif,nonaktif'
        ],
        [
            'kategori_layanan_id.required'=>'Kategori layanan harus dipilih.',
            'nama_layanan.required'=>'Nama layanan harus diisi.',
            'nama_layanan.unique'=>'Nama layanan sudah ada.',
            'harga.required'=>'Harga layanan harus diisi.',
            'estimasi_menit.required'=>'Estimasi menit layanan harus diisi.',
            'status.required'=>'Status layanan harus dipilih.'
        ]);

        $layanan=Layanan::findOrFail($id);

        $layanan->update([
            'kategori_layanan_id'=>$request->kategori_layanan_id,
            'nama_layanan'=>$request->nama_layanan,
            'harga'=>$request->harga,
            'estimasi_menit'=>$request->estimasi_menit,
            'deskripsi'=>$request->deskripsi,
            'status'=>$request->status
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success','Data layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan=Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success','Data layanan berhasil dihapus.');
    }
}