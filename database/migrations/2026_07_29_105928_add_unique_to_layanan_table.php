<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan',function(Blueprint $table){
            $table->unique(['kategori_layanan_id','nama_layanan'],'layanan_kategori_nama_unique');
        });
    }

    public function down(): void
    {
        Schema::table('layanan',function(Blueprint $table){
            $table->dropUnique('layanan_kategori_nama_unique');
        });
    }
};