<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    protected $table='kategori_layanan';

    protected $fillable=[
        'nama_kategori',
        'deskripsi'
    ];

    public function layanan()
    {
        return $this->hasMany(Layanan::class,'kategori_layanan_id');
    }
}