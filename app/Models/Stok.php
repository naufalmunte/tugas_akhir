<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\StokTransaksi;


class Stok extends Model
{
    protected $table='stok';

    protected $fillable = [
        'nama_barang',
        'satuan',
        'stok',
        'stok_minimum',
    ];

    public function transaksi()
    {
        return $this->hasMany(StokTransaksi::class);
    }
}
