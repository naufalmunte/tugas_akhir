<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Stok;


class StokTransaksi extends Model
{
    protected $table='stok_transaksi';

    protected $fillable = [
        'stok_id',
        'jenis',
        'jumlah',
        'keterangan',
    ];

    public function stok()
    {
        return $this->belongsTo(
            Stok::class,'stok_id'
        );
    }
}
