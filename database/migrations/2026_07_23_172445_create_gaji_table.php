<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periode_gaji_id')
                ->constrained('periode_gaji')
                ->cascadeOnDelete();

            $table->foreignId('karyawan_id')
                ->constrained('karyawan')
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah_order');

            $table->decimal('total_gaji', 12, 2);

            $table->timestamps();

            $table->unique(['periode_gaji_id', 'karyawan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};