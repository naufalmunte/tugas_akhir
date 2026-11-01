<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periode_gaji', function (Blueprint $table) {
            $table->decimal('persentase_gaji', 5, 2)
                ->after('bulan');

            $table->dropColumn('gaji_per_order');
        });
    }

    public function down(): void
    {
        Schema::table('periode_gaji', function (Blueprint $table) {
            $table->decimal('gaji_per_order', 12, 2)
                ->after('bulan');

            $table->dropColumn('persentase_gaji');
        });
    }
};