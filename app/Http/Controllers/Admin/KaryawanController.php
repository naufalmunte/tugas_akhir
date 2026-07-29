<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $karyawan = Karyawan::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(1)
            ->withQueryString();

        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|max:100',
            'no_hp' => 'required|max:20|unique:karyawan,no_hp',
        ],
        [
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
        ]);

        Karyawan::create([
            'nama'=>$request->nama,
            'no_hp'=>$request->no_hp
        ]);

        return redirect()->route('admin.karyawan.index')
            ->with('success','Data karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan=Karyawan::findOrFail($id);

        return view('admin.karyawan.edit',compact('karyawan'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama'=>'required|max:100',
            'no_hp' => 'required|max:20|unique:karyawan,no_hp,' . $id,
        ],
        [
            'no_hp.unique' => 'Nomor HP sudah terdaftar.',
        ]);

        $karyawan=Karyawan::findOrFail($id);

        $karyawan->update([
            'nama'=>$request->nama,
            'no_hp'=>$request->no_hp
        ]);

        return redirect()->route('admin.karyawan.index')
            ->with('success','Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $karyawan=Karyawan::findOrFail($id);

        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')
            ->with('success','Data karyawan berhasil dihapus.');
    }
}