<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategori_layanan', function (Blueprint $table) {
            $table->unique('nama_kategori');
        });
    }

    public function down(): void
    {
        Schema::table('kategori_layanan', function (Blueprint $table) {
            $table->dropUnique(['nama_kategori']);
        });
    }
};