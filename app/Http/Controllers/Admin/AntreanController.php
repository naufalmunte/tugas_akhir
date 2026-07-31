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
        $kendaraan = Antrean::with([
            'order.pelanggan',
            'order.kendaraan',
            'order.layanan',
            'order.karyawan',
        ])
        ->whereNotNull('nomor_antrean')
        ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
        ->oldest()
        ->paginate(10, ['*'], 'kendaraan');

        $karpet = Antrean::with([
            'order.pelanggan',
            'order.kendaraan',
            'order.layanan',
            'order.karyawan',
        ])
        ->whereNull('nomor_antrean')
        ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
        ->oldest()
        ->paginate(10, ['*'], 'karpet');

        $karyawan = Karyawan::orderBy('nama')->get();

        return view('admin.antrean.index',compact('kendaraan', 'karpet', 'karyawan'));
    }

    public function mulai(Request $request, Antrean $antrean)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id'
        ]);

        $antrean->load('order.layanan.kategori');

        if ($antrean->order->layanan->kategori->butuh_kendaraan) {

            $dipakai = Order::where('karyawan_id', $request->karyawan_id)
                ->whereHas('antrean', function ($q) {
                    $q->where('status', 'Diproses');
                })
                ->whereHas('layanan.kategori', function ($q) {
                    $q->where('butuh_kendaraan', true);
                })
                ->exists();

            if ($dipakai) {
                return back()->with('error', 'Karyawan sedang mengerjakan kendaraan lain.');
            }
        }

        $antrean->order->update([
            'karyawan_id' => $request->karyawan_id
        ]);

        $antrean->update([
            'status' => 'Diproses'
        ]);

        return back()->with('success', 'Pengerjaan dimulai.');
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

    public function batalkan(Antrean $antrean)
    {
        if ($antrean->status != 'Menunggu') {
            return back()->with('error', 'Order yang sudah diproses tidak dapat dibatalkan.');
        }

        $antrean->update([
            'status' => 'Dibatalkan',
        ]);

        return back()->with('success', 'Order berhasil dibatalkan.');
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