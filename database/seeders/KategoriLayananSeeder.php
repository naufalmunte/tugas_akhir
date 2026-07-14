<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriLayanan;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        KategoriLayanan::create([
            'nama_kategori'=>'Cuci Mobil',
            'butuh_kendaraan'=>true
        ]);

        KategoriLayanan::create([
            'nama_kategori'=>'Cuci Motor',
            'butuh_kendaraan'=>true
        ]);

        KategoriLayanan::create([
            'nama_kategori'=>'Cuci Karpet',
            'butuh_kendaraan'=>false
]);
    }
}