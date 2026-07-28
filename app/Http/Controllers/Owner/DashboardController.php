<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\Stok;
use Illuminate\Http\Request;
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
                'tahunList'
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