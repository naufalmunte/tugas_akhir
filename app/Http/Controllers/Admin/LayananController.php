<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan=Layanan::with('kategori')->latest()->get();
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
            'nama_layanan'=>'required|max:100',
            'harga'=>'required|numeric|min:0',
            'estimasi_menit'=>'required|integer|min:1',
            'deskripsi'=>'nullable',
            'status'=>'required|in:aktif,nonaktif'
        ]);

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
            'nama_layanan'=>'required|max:100',
            'harga'=>'required|numeric|min:0',
            'estimasi_menit'=>'required|integer|min:1',
            'deskripsi'=>'nullable',
            'status'=>'required|in:aktif,nonaktif'
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