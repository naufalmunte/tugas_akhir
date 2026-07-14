<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    protected $table='antrean';

    protected $fillable=[
        'order_id',
        'nomor_antrean',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}