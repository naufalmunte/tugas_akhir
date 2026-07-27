<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Karyawan;
use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\Stok;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();

        $orderHariIni = Order::whereDate('created_at', today())->count();

        $prosesAktif = Antrean::whereIn('status', [
            'Menunggu',
            'Diproses',
            'Menunggu Pembayaran',
        ])->count();

        $totalKaryawan = Karyawan::count();

        $kendaraanDiproses = Antrean::whereNotNull('nomor_antrean')
            ->where('status', 'Diproses')
            ->count();

        $kendaraanMenunggu = Antrean::whereNotNull('nomor_antrean')
            ->where('status', 'Menunggu')
            ->count();

        $karpetAktif = Antrean::whereNull('nomor_antrean')
            ->whereIn('status', [
                'Menunggu',
                'Diproses',
                'Menunggu Pembayaran',
            ])
            ->count();

        $stokMenipis = Stok::whereColumn('stok', '<=', 'stok_minimum')->count();

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'orderHariIni',
            'prosesAktif',
            'totalKaryawan',
            'kendaraanDiproses',
            'kendaraanMenunggu',
            'karpetAktif',
            'stokMenipis'
        ));
    }
}