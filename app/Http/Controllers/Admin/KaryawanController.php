<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan=Karyawan::latest()->get();
        return view('admin.karyawan.index',compact('karyawan'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|max:100',
            'no_hp'=>'required|max:20'
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
            'no_hp'=>'required|max:20'
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