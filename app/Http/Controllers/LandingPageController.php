<?php

namespace App\Http\Controllers;

use App\Models\ProfilBisnis;
use App\Models\KategoriLayanan;

class LandingPageController extends Controller
{
    public function index()
    {
        $profil = ProfilBisnis::first();

        $kategoriLayanan = KategoriLayanan::with('layanan')->get();

        return view('landing', compact(
            'profil',
            'kategoriLayanan'
        ));
    }
}