<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        Kendaraan::create([
            'pelanggan_id'=>6,
            'jenis_kendaraan'=>'Mobil',
            'plat_nomor'=>'BA 1234 NA',
            'merk'=>'Toyota'
        ]);

        Kendaraan::create([
            'pelanggan_id'=>7,
            'jenis_kendaraan'=>'Motor',
            'plat_nomor'=>'BA 5678 HM',
            'merk'=>'Honda'
        ]);
    }
}