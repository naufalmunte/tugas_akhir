<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriLayanan;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        KategoriLayanan::insert([
            [
                'nama_kategori'=>'Cuci Mobil',
                'deskripsi'=>'Layanan pencucian mobil'
            ],
            [
                'nama_kategori'=>'Cuci Motor',
                'deskripsi'=>'Layanan pencucian motor'
            ],
            [
                'nama_kategori'=>'Cuci Karpet',
                'deskripsi'=>'Layanan pencucian karpet'
            ]
        ]);
    }
}