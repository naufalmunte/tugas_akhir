<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_bisnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('jam_operasional');
            $table->text('maps_embed')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_bisnis');
    }
};