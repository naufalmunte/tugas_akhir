<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\KategoriLayanan;
use App\Models\Kendaraan;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::with([
            'pelanggan',
            'kendaraan',
            'layanan',
            'karyawan',
            'antrean'
        ])->latest()->get();

        return view('admin.order.index',compact('orders'));
    }

public function create()
{
    if(!session()->has('pelanggan_id')){

        return redirect()->route('admin.order.index')
            ->with('error','Silakan scan QR Member terlebih dahulu.');

    }

    $pelanggan=Pelanggan::findOrFail(
        session('pelanggan_id')
    );

    $kategori=KategoriLayanan::orderBy('nama_kategori')->get();

    return view('admin.order.create',compact(
        'pelanggan',
        'kategori'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'=>'required|exists:pelanggans,id',
            'layanan_id'=>'required|exists:layanan,id',
            'kendaraan_id'=>'nullable|exists:kendaraan,id'
        ]);

        DB::beginTransaction();

        try{

            $layanan=Layanan::findOrFail($request->layanan_id);

            $order=Order::create([
                'pelanggan_id'=>$request->pelanggan_id,
                'kendaraan_id'=>$request->kendaraan_id,
                'layanan_id'=>$request->layanan_id,
                'harga'=>$layanan->harga,
                'karyawan_id'=>null,
                'metode_pembayaran'=>null
            ]);

            $today=date('Y-m-d');

            $jumlah=Antrean::whereDate('created_at',$today)->count()+1;

            $nomor='A'.str_pad($jumlah,3,'0',STR_PAD_LEFT);

            Antrean::create([
                'order_id'=>$order->id,
                'nomor_antrean'=>$nomor,
                'status'=>'Menunggu'
            ]);

            DB::commit();

            session()->forget('pelanggan_id');

            return redirect()->route('admin.order.index')
    ->with('success','Order berhasil dibuat.');

        }catch(\Exception $e){

            DB::rollBack();

            return back()->withInput()->with('error',$e->getMessage());

        }
    }

    public function getLayanan($kategori)
    {
        $layanan=Layanan::where('kategori_layanan_id',$kategori)
            ->orderBy('nama_layanan')
            ->get();

        return response()->json($layanan);
    }

    public function getKendaraan($pelanggan)
    {
        $kendaraan=Kendaraan::where('pelanggan_id',$pelanggan)
            ->orderBy('plat_nomor')
            ->get();

        return response()->json($kendaraan);
    }

   public function getPelanggan($id)
{
    $pelanggan=Pelanggan::find($id);

    if(!$pelanggan){
        return response()->json([
            'success'=>false
        ]);
    }

    return response()->json([
        'success'=>true,
        'data'=>[
            'id'=>$pelanggan->id,
            'nama'=>$pelanggan->nama,
            'no_hp'=>$pelanggan->no_hp
        ]
    ]);
}

public function scanQr(Request $request)
{
    $pelanggan=Pelanggan::find($request->pelanggan_id);

    if(!$pelanggan){

        return response()->json([
            'success'=>false
        ]);

    }

    session([
        'pelanggan_id'=>$pelanggan->id
    ]);

    return response()->json([
        'success'=>true,
        'redirect'=>route('admin.order.create')
    ]);
}
}