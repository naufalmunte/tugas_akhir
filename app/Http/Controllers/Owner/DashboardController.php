<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\Stok;
use Illuminate\Http\Request;
use App\Models\PeriodeGaji;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan=Pelanggan::count();

        $totalOrder=Order::count();

        $pendapatan=Order::whereHas('antrean',function($q){
            $q->where('status','Selesai');
        })->sum('harga');
        
        $stokMenipis=Stok::whereColumn(
            'stok',
            '<=',
            'stok_minimum'
        )->count();

        $orderHariIni=Order::whereDate(
            'created_at',
            today()
        )->count();

        $antreanAktif=Antrean::whereIn(
            'status',
            [
                'Menunggu',
                'Diproses',
                'Menunggu Pembayaran'
            ]
        )->count();

        $bulanSekarang = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $tahunSekarang = now()->year;
        $namaBulanSekarang = $bulanSekarang[now()->month];

        $periodeGajiSekarang = PeriodeGaji::where('tahun', $tahunSekarang)
            ->where('bulan', $namaBulanSekarang)
            ->first();

        $periodeGajiTerbaru = PeriodeGaji::latest('id')
            ->take(3)
            ->get();

        $tahunList = Order::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view(
            'owner.dashboard',
            compact(
                'totalPelanggan',
                'totalOrder',
                'pendapatan',
                'stokMenipis',
                'orderHariIni',
                'antreanAktif',
                'tahunList', 
                'periodeGajiSekarang',
                'periodeGajiTerbaru',
                'tahunSekarang',
                'namaBulanSekarang'
            )
        );
    }

    public function chartOrder(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
        $data = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $data[] = Order::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->count();
        }return response()->json($data);
    }
}