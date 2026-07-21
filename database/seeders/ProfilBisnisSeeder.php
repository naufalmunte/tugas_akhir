<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilBisnis;

class ProfilBisnisSeeder extends Seeder
{
    public function run(): void
    {
        ProfilBisnis::create([
            'nama_usaha' => 'Door Smeer Mobil',
            'logo' => null,
            'deskripsi' => 'Melayani cuci mobil, cuci motor, dan cuci karpet dengan pelayanan terbaik.',
            'alamat' => 'Jl. By Pass, Padang',
            'no_hp' => '081234567890',
            'email' => 'doorsmeer@example.com',
            'jam_operasional' => '08.00 - 20.00 WIB',
            'maps_embed' => null,
        ]);
    }
}