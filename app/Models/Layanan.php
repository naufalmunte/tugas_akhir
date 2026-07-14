<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table='layanan';

    protected $fillable=[
        'kategori_layanan_id',
        'nama_layanan',
        'harga',
        'estimasi_menit',
        'deskripsi',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class,'kategori_layanan_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}