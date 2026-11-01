<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;
use App\Models\Karyawan;
use App\Models\Antrean;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\KategoriLayanan;

class Order extends Model
{
    protected $table='orders';

    protected $fillable=[
        'pelanggan_id',
        'kendaraan_id',
        'layanan_id',
        'harga',
        'metode_pembayaran',
        'midtrans_order_id',
        'status_pembayaran',     
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan   ::class);
    }


    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function karyawan()
    {
        return $this->belongsToMany(
            Karyawan::class,
            'order_karyawan',
            'order_id',
            'karyawan_id'
        )->withTimestamps();
    }

    public function antrean()
    {
        return $this->hasOne(Antrean::class);
    }
}