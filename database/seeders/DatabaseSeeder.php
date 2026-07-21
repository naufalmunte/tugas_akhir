<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriLayanan;
use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            // KategoriLayananSeeder::class,
            // KendaraanSeeder::class,
            ProfilBisnisSeeder::class,
        ]);
    }
}
