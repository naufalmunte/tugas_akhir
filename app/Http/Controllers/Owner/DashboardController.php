<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\Stok;

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

        return view(
            'owner.dashboard',
            compact(
                'totalPelanggan',
                'totalOrder',
                'pendapatan',
                'stokMenipis',
                'orderHariIni',
                'antreanAktif'
            )
        );
    }
}