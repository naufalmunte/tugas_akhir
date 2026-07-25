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
    Schema::table('antrean', function (Blueprint $table) {
        $table->string('nomor_antrean')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('antrean', function (Blueprint $table) {
        $table->string('nomor_antrean')->nullable(false)->change();
    });
}
};
