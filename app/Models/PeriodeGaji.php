<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeGaji extends Model
{
    use HasFactory;

    protected $table = 'periode_gaji';

    protected $fillable = [
        'tahun',
        'bulan',
        'gaji_per_order',
    ];

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}