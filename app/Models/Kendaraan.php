<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table='kendaraan';

    protected $fillable=[
        'pelanggan_id',
        'jenis_kendaraan',
        'plat_nomor',
        'merk'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }
}