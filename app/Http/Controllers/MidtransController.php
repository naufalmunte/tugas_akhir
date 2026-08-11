<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        Log::info('MIDTRANS NOTIFICATION:', $request->all());

        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status;

        $order = Order::where('midtrans_order_id', $orderId)->first();

        if (!$order) {
            Log::warning('Order Midtrans tidak ditemukan', [
                'order_id' => $orderId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan.'
            ], 404);
        }

        if (
            $transactionStatus === 'settlement' ||
            (
                $transactionStatus === 'capture' &&
                $fraudStatus === 'accept'
            )
        ) {
            $order->update([
                'status_pembayaran' => 'paid',
            ]);

            if ($order->antrean) {
                $order->antrean->update([
                    'status' => 'Selesai',
                ]);
            }

            Log::info('Pembayaran berhasil diperbarui', [
                'order_id' => $orderId,
                'order_database_id' => $order->id,
            ]);
        }

        elseif ($transactionStatus === 'pending') {
            $order->update([
                'status_pembayaran' => 'pending',
            ]);
        }

        elseif (
            $transactionStatus === 'deny' ||
            $transactionStatus === 'cancel' ||
            $transactionStatus === 'expire'
        ) {
            $order->update([
                'status_pembayaran' => 'failed',
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}