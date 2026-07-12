<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan=Pelanggan::oldest()->paginate(10);
        return view('admin.pelanggan.index',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|max:100',
            'no_hp'=>'required|max:20',
            'alamat'=>'nullable'
        ]);

        $pelanggan=Pelanggan::create([
            'nama'=>$request->nama,
            'no_hp'=>$request->no_hp,
            'alamat'=>$request->alamat
        ]);

        $namaFile='pelanggan-'.$pelanggan->id.'.png';

        $result=Builder::create()
            ->writer(new PngWriter())
            ->data((string)$pelanggan->id)
            ->size(300)
            ->margin(10)
            ->build();

        Storage::disk('public')->put(
            'qrcodes/'.$namaFile,
            $result->getString()
        );

        $pelanggan->update([
            'qr_code_path'=>'qrcodes/'.$namaFile
        ]);

        return redirect()->route('admin.pelanggan.index')->with('success','Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelanggan=Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit',compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id){
        $request->validate([
            'nama'=>'required|max:100',
            'no_hp'=>'required|max:20',
            'alamat'=>'nullable'
        ]);

        $pelanggan=Pelanggan::findOrFail($id);

        $pelanggan->update([
            'nama'=>$request->nama,
            'no_hp'=>$request->no_hp,
            'alamat'=>$request->alamat
        ]);

        return redirect()->route('admin.pelanggan.index')
            ->with('success','Data pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $pelanggan=Pelanggan::findOrFail($id);

        if($pelanggan->qr_code_path){
            Storage::disk('public')->delete($pelanggan->qr_code_path);
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')->with('success','Data pelanggan berhasil dihapus.');
    }
}
