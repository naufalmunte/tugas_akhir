<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok',function(Blueprint $table){

            $table->id();
            $table->string('nama_barang');
            $table->enum('satuan',['Botol','Liter','Pcs']);
            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};