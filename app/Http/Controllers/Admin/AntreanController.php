<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Services\QrisService;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Order;
use App\Services\MidtransService;

class AntreanController extends Controller
{
    public function index()
    {
        $kendaraan = Antrean::with([
            'order.pelanggan',
            'order.kendaraan',
            'order.layanan',
            'order.karyawan',
        ])
        ->whereNotNull('nomor_antrean')
        ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
        ->oldest()
        ->paginate(10, ['*'], 'kendaraan');

        $karpet = Antrean::with([
            'order.pelanggan',
            'order.kendaraan',
            'order.layanan',
            'order.karyawan',
        ])
        ->whereNull('nomor_antrean')
        ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
        ->oldest()
        ->paginate(10, ['*'], 'karpet');

        $karyawan = Karyawan::orderBy('nama')->get();

        return view('admin.antrean.index',compact('kendaraan', 'karpet', 'karyawan'));
    }

    public function mulai(Request $request, Antrean $antrean)
{
    $request->validate([
        'karyawan_id' => 'required|array|min:1',
        'karyawan_id.*' => 'exists:karyawan,id',
    ], [
        'karyawan_id.required' => 'Pilih minimal satu karyawan.',
        'karyawan_id.array' => 'Data karyawan tidak valid.',
        'karyawan_id.min' => 'Pilih minimal satu karyawan.',
        'karyawan_id.*.exists' => 'Karyawan yang dipilih tidak ditemukan.',
    ]);

    $antrean->load('order.layanan.kategori');

    $order = $antrean->order;

    // Jika order membutuhkan kendaraan (mobil / motor)
    if ($order->layanan->kategori->butuh_kendaraan) {

        $karyawanSibuk = Karyawan::whereIn('id', $request->karyawan_id)
            ->whereHas('orders', function ($query) use ($order) {

                $query->where('orders.id', '!=', $order->id)
                    ->whereHas('antrean', function ($q) {
                        $q->where('status', 'Diproses');
                    })
                    ->whereHas('layanan.kategori', function ($q) {
                        $q->where('butuh_kendaraan', true);
                    });

            })
            ->pluck('nama');

        if ($karyawanSibuk->isNotEmpty()) {
            return back()->with(
                'error',
                'Karyawan ' . $karyawanSibuk->join(', ') .
                ' sedang mengerjakan kendaraan lain.'
            );
        }
    }

    // Simpan beberapa karyawan ke pivot order_karyawan
    $order->karyawan()->sync($request->karyawan_id);

    // Ubah status antrean
    $antrean->update([
        'status' => 'Diproses'
    ]);

    return back()->with(
        'success',
        'Pengerjaan berhasil dimulai.'
    );
}

    public function selesaiCuci(Antrean $antrean)
    {
        $antrean->update([
            'status'=>'Menunggu Pembayaran'
        ]);

        return back()->with('success','Menunggu pembayaran.');
    }

    public function bayar(Request $request, Antrean $antrean)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:Cash,QRIS,Transfer'
        ]);

        $antrean->order->update([
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        if ($request->metode_pembayaran === 'Cash') {
            $antrean->order->update([
                'status_pembayaran' => 'paid',
            ]);

            $antrean->update([
                'status' => 'Selesai',
            ]);

            return redirect()
                ->route('admin.antrean.index')
                ->with('success', 'Pembayaran berhasil.');
        }
        return redirect()
            ->route('admin.antrean.index')
            ->with('success', 'Silakan lanjutkan pembayaran melalui Midtrans.');
    }

    public function createPayment(
        Request $request,
        Antrean $antrean,
        MidtransService $midtransService
    ) {
        $request->validate([
            'metode_pembayaran' => 'required|in:QRIS,Transfer',
        ]);

        if ($antrean->status !== 'Menunggu Pembayaran') {
            return response()->json([
                'success' => false,
                'message' => 'Order belum dapat melakukan pembayaran.'
            ], 422);
        }

        $antrean->load('order.pelanggan', 'order.layanan');

        $order = $antrean->order;

        $order->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'pending',
        ]);

        $payment = $midtransService->createTransaction($order);

        return response()->json([
            'success' => true,
            'snap_token' => $payment['snap_token'],
            'order_id' => $payment['order_id'],
        ]);
    }

    public function pembayaranBerhasil(Antrean $antrean)
    {
        $antrean->load('order');

        if (!$antrean->order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan.'
            ], 404);
        }

        $antrean->order->update([
            'status_pembayaran' => 'paid',
        ]);

        $antrean->update([
            'status' => 'Selesai',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diperbarui.'
        ]);
    }


    public function batalkan(Antrean $antrean)
    {
        if ($antrean->status != 'Menunggu') {
            return back()->with('error', 'Order yang sudah diproses tidak dapat dibatalkan.');
        }

        $antrean->update([
            'status' => 'Dibatalkan',
        ]);

        return back()->with('success', 'Order berhasil dibatalkan.');
    }

}