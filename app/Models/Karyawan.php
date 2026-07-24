<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table='karyawan';

    protected $fillable=[
        'nama',
        'no_hp'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}