<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Order $order)
    {
        $midtransOrderId = 'DOORSMEER-' . $order->id . '-' . time();

        $order->update([
            'midtrans_order_id' => $midtransOrderId,
            'status_pembayaran' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => (int) $order->harga,
            ],

            'callbacks' => [
                'finish' => route('admin.antrean.index'),
            ],

            'customer_details' => [
                'first_name' => $order->pelanggan->nama,
                'phone' => $order->pelanggan->no_hp,
            ],

            'item_details' => [
                [
                    'id' => (string) $order->layanan_id,
                    'price' => (int) $order->harga,
                    'quantity' => 1,
                    'name' => $order->layanan->nama_layanan,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return [
            'order_id' => $midtransOrderId,
            'snap_token' => $snapToken,
        ];
    }
}