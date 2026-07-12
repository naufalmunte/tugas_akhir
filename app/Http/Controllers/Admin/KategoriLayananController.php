<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{
    public function index()
    {
        $kategori=KategoriLayanan::oldest()->get();
        return view('admin.kategori-layanan.index',compact('kategori'));

    }

    public function create()
    {
        return view('admin.kategori-layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori'=>'required|max:100',
            'deskripsi'=>'nullable'
        ]);

        KategoriLayanan::create([
            'nama_kategori'=>$request->nama_kategori,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect()->route('admin.kategori-layanan.index')->with('success','Kategori layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori=KategoriLayanan::findOrFail($id);
        return view('admin.kategori-layanan.edit',compact('kategori'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_kategori'=>'required|max:100',
            'deskripsi'=>'nullable'
        ]);

        $kategori=KategoriLayanan::findOrFail($id);

        $kategori->update([
            'nama_kategori'=>$request->nama_kategori,
            'deskripsi'=>$request->deskripsi
        ]);

        return redirect()->route('admin.kategori-layanan.index')->with('success','Kategori layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori=KategoriLayanan::findOrFail($id);

        $kategori->delete();

        return redirect()->route('admin.kategori-layanan.index')->with('success','Kategori layanan berhasil dihapus.');
    }
}