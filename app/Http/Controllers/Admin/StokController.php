<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stok;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    public function index()
    {
        $stok=Stok::orderBy('nama_barang')->get();

        $transaksi=StokTransaksi::with('stok')
            ->latest()
            ->get();

        return view('admin.stok.index',compact(
            'stok',
            'transaksi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'=>'required|max:100',
            'satuan'=>'required|in:Botol,Liter,Pcs',
            'stok'=>'required|integer|min:0',
            'stok_minimum'=>'required|integer|min:0'
        ]);

        Stok::create([
            'nama_barang'=>$request->nama_barang,
            'satuan'=>$request->satuan,
            'stok'=>$request->stok,
            'stok_minimum'=>$request->stok_minimum
        ]);

        return back()->with(
            'success',
            'Barang berhasil ditambahkan.'
        );
    }

    public function transaksi(Request $request)
    {
        $request->validate([
            'stok_id'=>'required|exists:stok,id',
            'jenis'=>'required|in:Masuk,Keluar',
            'jumlah'=>'required|integer|min:1',
            'keterangan'=>'nullable|max:255'
        ]);

        DB::beginTransaction();

        try{

            $stok=Stok::findOrFail($request->stok_id);

            if($request->jenis=='Keluar'){

                if($request->jumlah>$stok->stok){

                    return back()->with(
                        'error',
                        'Stok tidak mencukupi.'
                    );

                }

                $stok->decrement(
                    'stok',
                    $request->jumlah
                );

            }else{

                $stok->increment(
                    'stok',
                    $request->jumlah
                );

            }

            StokTransaksi::create([
                'stok_id'=>$stok->id,
                'jenis'=>$request->jenis,
                'jumlah'=>$request->jumlah,
                'keterangan'=>$request->keterangan
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Transaksi stok berhasil.'
            );

        }catch(\Exception $e){

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}