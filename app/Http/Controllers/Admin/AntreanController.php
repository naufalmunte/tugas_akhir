<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Services\QrisService;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Order;

class AntreanController extends Controller
{

    private $qrisStatis="00020101021126610014COM.GO-JEK.WWW01189360091436689735970210G6689735970303UMI51440014ID.CO.QRIS.WWW0215ID10254391372470303UMI5204472253033605802ID5915Lasax Adventure6006PADANG61052511162070703A0163041497";
    public function index()
    {
        $antrean=Antrean::with([
            'order.pelanggan',
            'order.kendaraan',
            'order.layanan',
            'order.karyawan',
        ])->latest()->paginate(10);

        $busy=Order::whereHas('antrean',function($q){
            $q->where('status','Diproses');
        })
        ->whereNotNull('karyawan_id')
        ->pluck('karyawan_id');

        $karyawan=Karyawan::whereNotIn('id',$busy)
            ->orderBy('nama')
            ->get();
        return view('admin.antrean.index',compact('antrean','karyawan'));
    }

    public function mulai(Request $request,Antrean $antrean)
    {
        $request->validate([
            'karyawan_id'=>'required|exists:karyawan,id'
        ]);

        $dipakai=Order::where('karyawan_id',$request->karyawan_id)
            ->whereHas('antrean',function($q){
                $q->where('status','Diproses');
            })
            ->exists();

        if($dipakai){
            return back()->with('error','Karyawan sedang mengerjakan order lain.');
        }
        $antrean->order->update([
            'karyawan_id'=>$request->karyawan_id
        ]);

        $antrean->update([
            'status'=>'Diproses'
        ]);

        return back()->with('success','Pengerjaan dimulai.');
    }

    public function selesaiCuci(Antrean $antrean)
    {
        $antrean->update([
            'status'=>'Menunggu Pembayaran'
        ]);

        return back()->with('success','Menunggu pembayaran.');
    }

    public function bayar(Request $request,Antrean $antrean)
    {
        $request->validate([
            'metode_pembayaran'=>'required|in:Cash,QRIS'
        ]);

        $antrean->order->update([
            'metode_pembayaran'=>$request->metode_pembayaran
        ]);

        $antrean->update([
            'status'=>'Selesai'
        ]);

        return redirect()->route('admin.antrean.index')
            ->with('success','Pembayaran berhasil.');
    }

    public function generateQris(Antrean $antrean,QrisService $qrisService)
    {
        $payload=$qrisService->makeDynamic(
            $this->qrisStatis,
            $antrean->order->harga
        );

        $antrean->order->update([
            'qris_payload'=>$payload
        ]);

        $result=Builder::create()
            ->writer(new PngWriter())
            ->data($payload)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(280)
            ->margin(10)
            ->build();

        return response()->json([
            'image'=>'data:image/png;base64,'.base64_encode($result->getString())
        ]);
    }
}