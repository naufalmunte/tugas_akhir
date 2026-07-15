<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\StokTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function order(Request $request)
    {
        $query=Order::with([
            'pelanggan',
            'kendaraan',
            'layanan',
            'karyawan',
            'antrean'
        ]);

        if($request->filled('tanggal')){
            $query->whereDate('created_at',$request->tanggal);
        }

        $totalOrder=(clone $query)->count();

        $totalPendapatan=(clone $query)
            ->whereHas('antrean',function($q){
                $q->where('status','Selesai');
            })
            ->sum('harga');

        $order=$query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('owner.laporan.order',compact(
            'order',
            'totalOrder',
            'totalPendapatan'
        ));
    }

    public function cetakOrder(Request $request)
    {
        $query=Order::with([
            'pelanggan',
            'layanan',
            'karyawan',
            'antrean'
        ]);

        if($request->filled('tanggal')){
            $query->whereDate(
                'created_at',
                $request->tanggal
            );
        }

        $order=$query
            ->latest()
            ->get();

        $totalPendapatan=$order
            ->filter(function($item){

                return $item->antrean &&
                    $item->antrean->status=='Selesai';

            })
            ->sum('harga');

        $pdf=Pdf::loadView(
            'owner.laporan.pdf.order',
            compact(
                'order',
                'totalPendapatan'
            )
        );

        return $pdf->stream(
            'laporan-order.pdf'
        );
    }


    public function stok(Request $request)
    {
        $stok=StokTransaksi::with('stok');
        if($request->filled('tanggal')){
            $stok->whereDate('created_at',$request->tanggal);
        }
        if($request->filled('bulan')){
            $bulan=explode('-',$request->bulan);
            $stok->whereYear('created_at',$bulan[0])->whereMonth('created_at',$bulan[1]);
        }
        $stok=$stok->latest()->paginate(10)->withQueryString();
        return view('owner.laporan.stok',compact('stok'));
    }

    public function cetakStok(Request $request)
    {
        $stok=StokTransaksi::with('stok');
        if($request->filled('tanggal')){
            $stok->whereDate('created_at',$request->tanggal);
        }
        if($request->filled('bulan')){
            $bulan=explode('-',$request->bulan);
            $stok->whereYear('created_at',$bulan[0])->whereMonth('created_at',$bulan[1]);
        }
        $stok=$stok->latest()->get();
        $pdf=Pdf::loadView('owner.laporan.pdf.stok',compact('stok'));
        return $pdf->stream('laporan-stok.pdf');
    }


}
