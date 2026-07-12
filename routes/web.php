<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\KategoriLayananController;
use App\Http\Controllers\Admin\LayananController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/pelanggan',[PelangganController::class,'index'])->name('pelanggan.index');
    Route::get('/pelanggan/create',[PelangganController::class,'create'])->name('pelanggan.create');
    Route::post('/pelanggan/store',[PelangganController::class,'store'])->name('pelanggan.store');
    Route::get('/pelanggan/{id}/edit',[PelangganController::class,'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/{id}',[PelangganController::class,'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id}',[PelangganController::class,'destroy'])->name('pelanggan.destroy');

    Route::get('/kategori-layanan',[KategoriLayananController::class,'index'])->name('kategori-layanan.index');
    Route::get('/kategori-layanan/create',[KategoriLayananController::class,'create'])->name('kategori-layanan.create');
    Route::post('/kategori-layanan/store',[KategoriLayananController::class,'store'])->name('kategori-layanan.store');
    Route::get('/kategori-layanan/{id}/edit',[KategoriLayananController::class,'edit'])->name('kategori-layanan.edit');
    Route::put('/kategori-layanan/{id}',[KategoriLayananController::class,'update'])->name('kategori-layanan.update');
    Route::delete('/kategori-layanan/{id}',[KategoriLayananController::class,'destroy'])->name('kategori-layanan.destroy');

    Route::get('/layanan',[LayananController::class,'index'])->name('layanan.index');
    Route::get('/layanan/create',[LayananController::class,'create'])->name('layanan.create');
    Route::post('/layanan/store',[LayananController::class,'store'])->name('layanan.store');
    Route::get('/layanan/{id}/edit',[LayananController::class,'edit'])->name('layanan.edit');
    Route::put('/layanan/{id}',[LayananController::class,'update'])->name('layanan.update');
    Route::delete('/layanan/{id}',[LayananController::class,'destroy'])->name('layanan.destroy');
    
});

Route::middleware(['auth','role:owner'])->prefix('owner')->name('owner.')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');
    
});