<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;


class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan=Kendaraan::with('pelanggan')->latest()->get();

        return view('admin.kendaraan.index',compact('kendaraan'));
    }

    public function create(Pelanggan $pelanggan)
    {
        return view('admin.kendaraan.create',compact('pelanggan'));
    }

   public function store(Request $request,Pelanggan $pelanggan)
{
    try{

        $request->validate([
            'jenis_kendaraan'=>'required|in:Mobil,Motor',
            'plat_nomor'=>'required|max:20|unique:kendaraan,plat_nomor',
            'merk'=>'required|max:100'
        ]);

        $kendaraan=Kendaraan::create([
            'pelanggan_id'=>$pelanggan->id,
            'jenis_kendaraan'=>$request->jenis_kendaraan,
            'plat_nomor'=>$request->plat_nomor,
            'merk'=>$request->merk
        ]);

        return response()->json([
            'success'=>true,
            'id'=>$kendaraan->id,
            'plat_nomor'=>$kendaraan->plat_nomor,
            'merk'=>$kendaraan->merk
        ]);

    }catch(\Throwable $e){

        return response()->json([
            'success'=>false,
            'message'=>$e->getMessage(),
            'line'=>$e->getLine(),
            'file'=>$e->getFile()
        ],500);

    }
}

    public function edit($id)
    {
        $kendaraan=Kendaraan::findOrFail($id);

        return view('admin.kendaraan.edit',compact('kendaraan'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'jenis_kendaraan'=>'required|in:Mobil,Motor',
            'plat_nomor'=>'required|max:20|unique:kendaraan,plat_nomor,'.$id,
            'merk'=>'required|max:100'
        ]);

        $kendaraan=Kendaraan::findOrFail($id);

        $kendaraan->update([
            'jenis_kendaraan'=>$request->jenis_kendaraan,
            'plat_nomor'=>$request->plat_nomor,
            'merk'=>$request->merk
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success','Data kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kendaraan=Kendaraan::findOrFail($id);

        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index')
            ->with('success','Data kendaraan berhasil dihapus.');
    }
}