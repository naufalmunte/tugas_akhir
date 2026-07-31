<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\StokTransaksi;
use App\Models\Gaji;
use App\Models\PeriodeGaji;
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

    public function gaji(Request $request)
    {
        $laporan = Gaji::with(['karyawan', 'periodeGaji']);

        if ($request->filled('bulan')) {

            [$tahun, $bulan] = explode('-', $request->bulan);

            $namaBulan = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ];

            $laporan->whereHas('periodeGaji', function ($q) use ($tahun, $bulan, $namaBulan) {
                $q->where('tahun', $tahun)
                ->where('bulan', $namaBulan[$bulan]);
            });
        }

        $laporan = $laporan->paginate(10)->withQueryString();

        $totalOrder = $laporan->sum('jumlah_order');
        $totalGaji = $laporan->sum('total_gaji');

        return view('owner.laporan.gaji', compact(
            'laporan',
            'totalOrder',
            'totalGaji'
        ));
    }

    public function cetakGaji(Request $request)
    {
        $laporan = Gaji::with(['karyawan', 'periodeGaji']);

        if ($request->filled('bulan')) {

            [$tahun, $bulan] = explode('-', $request->bulan);

            $namaBulan = [
                '01'=>'Januari',
                '02'=>'Februari',
                '03'=>'Maret',
                '04'=>'April',
                '05'=>'Mei',
                '06'=>'Juni',
                '07'=>'Juli',
                '08'=>'Agustus',
                '09'=>'September',
                '10'=>'Oktober',
                '11'=>'November',
                '12'=>'Desember',
            ];

            $laporan->whereHas('periodeGaji', function ($q) use ($tahun, $bulan, $namaBulan) {
                $q->where('tahun', $tahun)
                ->where('bulan', $namaBulan[$bulan]);
            });
        }

        $laporan = $laporan->orderBy('karyawan_id')->get();

        $pdf = Pdf::loadView('owner.laporan.pdf.gaji', compact('laporan'));

        return $pdf->stream('laporan-gaji.pdf');
    }

    public function pendapatan(Request $request)
    {
        $pendapatan = Order::with([
            'pelanggan',
            'layanan',
            'antrean'
        ])
        ->whereHas('antrean', function ($q) {
            $q->where('status', 'Selesai');
        });

        if ($request->filled('bulan')) {

            $bulan = explode('-', $request->bulan);

            $pendapatan->whereYear('created_at', $bulan[0])
                ->whereMonth('created_at', $bulan[1]);
        }

        $pendapatan = $pendapatan
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalOrder = $pendapatan->total();

        $totalPendapatan = Order::whereHas('antrean', function ($q) {
                $q->where('status', 'Selesai');
            })
            ->when($request->filled('bulan'), function ($query) use ($request) {

                $bulan = explode('-', $request->bulan);

                $query->whereYear('created_at', $bulan[0])
                    ->whereMonth('created_at', $bulan[1]);
            })
            ->sum('harga');

        return view('owner.laporan.pendapatan', compact(
            'pendapatan',
            'totalOrder',
            'totalPendapatan'
        ));
    }

    public function cetakPendapatan(Request $request)
    {
        $pendapatan = Order::with([
            'pelanggan',
            'layanan',
            'antrean'
        ])
        ->whereHas('antrean', function ($q) {
            $q->where('status', 'Selesai');
        });

        if ($request->filled('bulan')) {

            $bulan = explode('-', $request->bulan);

            $pendapatan->whereYear('created_at', $bulan[0])
                ->whereMonth('created_at', $bulan[1]);
        }

        $pendapatan = $pendapatan
            ->latest()
            ->get();

        $totalPendapatan = $pendapatan->sum('harga');

        $pdf = Pdf::loadView(
            'owner.laporan.pdf.pendapatan',
            compact('pendapatan', 'totalPendapatan')
        );

        return $pdf->stream('laporan-pendapatan.pdf');
    }
}
