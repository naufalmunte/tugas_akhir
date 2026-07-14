<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategori_layanan', function (Blueprint $table) {
            $table->boolean('butuh_kendaraan')->default(true)->after('nama_kategori');
        });
    }

    public function down(): void
    {
        Schema::table('kategori_layanan', function (Blueprint $table) {
            $table->dropColumn('butuh_kendaraan');
        });
    }
};