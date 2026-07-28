<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;


class KendaraanController extends Controller
{
public function index(Request $request)
{
    $search=$request->search;

    $kendaraan=Kendaraan::with('pelanggan')
        ->when($search,function($query) use($search){

            $query->where('plat_nomor','like',"%{$search}%")
                  ->orWhere('merk','like',"%{$search}%")
                  ->orWhereHas('pelanggan',function($q) use($search){
                      $q->where('nama','like',"%{$search}%");
                  });

        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.kendaraan.index',compact('kendaraan'));
}

public function create(Request $request)
{
    $pelanggan=null;

    if(old('pelanggan_id')){
        $pelanggan=Pelanggan::find(old('pelanggan_id'));
    }elseif($request->filled('pelanggan_id')){
        $pelanggan=Pelanggan::find($request->pelanggan_id);
    }

    return view('admin.kendaraan.create',compact('pelanggan'));
}

public function scanQR(Request $request)
{
    $request->validate([
        'qr_code'=>'required'
    ]);

$pelanggan=Pelanggan::find($request->qr_code);
    if(!$pelanggan){
        return response()->json([
            'success'=>false,
            'message'=>'QR Code tidak ditemukan.'
        ]);
    }

    return response()->json([
        'success'=>true,
        'pelanggan'=>[
            'id'=>$pelanggan->id,
            'nama'=>$pelanggan->nama,
            'no_hp'=>$pelanggan->no_hp,
            'alamat'=>$pelanggan->alamat
        ]
    ]);
}

    public function store(Request $request)
{
    $request->validate([
        'pelanggan_id'     => 'required|exists:pelanggans,id',
        'jenis_kendaraan'  => 'required|in:Mobil,Motor',
        'plat_nomor'       => 'required|max:20|unique:kendaraan,plat_nomor',
        'merk'             => 'required|max:100'
    ],[
        'pelanggan_id.required'    => 'Pelanggan harus dipilih.',
        'pelanggan_id.exists'      => 'Pelanggan tidak ditemukan.',

        'jenis_kendaraan.required' => 'Jenis kendaraan wajib dipilih.',

        'plat_nomor.required'      => 'Plat nomor wajib diisi.',
        'plat_nomor.unique'        => 'Plat nomor sudah terdaftar.',

        'merk.required'            => 'Merk kendaraan wajib diisi.',
    ]);

    $kendaraan = Kendaraan::create([
        'pelanggan_id'    => $request->pelanggan_id,
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'plat_nomor'      => strtoupper($request->plat_nomor),
        'merk'            => $request->merk,
    ]);

    // Jika dipanggil dari AJAX (Form Order)
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'id' => $kendaraan->id,
            'plat_nomor' => $kendaraan->plat_nomor,
            'merk' => $kendaraan->merk,
        ]);
    }

    $pelanggan=Pelanggan::find($request->pelanggan_id);


    $request->merge([
    'pelanggan_nama'=>$pelanggan?->nama,
    'pelanggan_hp'=>$pelanggan?->no_hp,
    'pelanggan_alamat'=>$pelanggan?->alamat,
]);
    // Jika dipanggil dari halaman Kelola Kendaraan
    return redirect()
        ->route('admin.kendaraan.index')
        ->with('success', 'Data kendaraan berhasil ditambahkan.');
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