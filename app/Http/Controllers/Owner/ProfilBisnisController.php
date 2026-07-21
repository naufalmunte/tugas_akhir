<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ProfilBisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilBisnisController extends Controller
{
    public function index()
    {
        $profil = ProfilBisnis::first();
        return view('owner.profil_bisnis.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilBisnis::first();

        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'required|string|max:255',
            'maps_embed' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $validated['logo'] = $request->file('logo')->store('profil_bisnis', 'public');
        }
        $profil->update($validated);
        return redirect()
            ->route('owner.profil-bisnis.index')
            ->with('success', 'Profil bisnis berhasil diperbarui.');
    }
}