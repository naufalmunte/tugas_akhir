<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_transaksi',function(Blueprint $table){

            $table->id();
            $table->foreignId('stok_id')->constrained('stok')->cascadeOnDelete();
            $table->enum('jenis',['Masuk','Keluar']);
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_transaksi');
    }
};