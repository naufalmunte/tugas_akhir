<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $orders = DB::table('orders')
            ->whereNotNull('karyawan_id')
            ->select('id', 'karyawan_id')
            ->get();

        foreach ($orders as $order) {
            DB::table('order_karyawan')->insertOrIgnore([
                'order_id' => $order->id,
                'karyawan_id' => $order->karyawan_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('order_karyawan')->delete();
    }
};