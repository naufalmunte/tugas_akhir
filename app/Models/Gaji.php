<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    protected $fillable = [
        'periode_gaji_id',
        'karyawan_id',
        'jumlah_order',
        'total_gaji',
    ];

    public function periodeGaji()
    {
        return $this->belongsTo(PeriodeGaji::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}