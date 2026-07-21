<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilBisnis extends Model
{
    protected $table = 'profil_bisnis';

    protected $fillable = [
        'nama_usaha',
        'logo',
        'deskripsi',
        'alamat',
        'no_hp',
        'email',
        'jam_operasional',
        'maps_embed',
    ];
}