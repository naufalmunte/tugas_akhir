<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\KategoriLayananController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\StokController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\LaporanController;
use App\Http\Controllers\Owner\ProfilBisnisController;

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

    Route::get('/kendaraan',[KendaraanController::class,'index'])->name('kendaraan.index');
    Route::get('/kendaraan/edit/{id}',[KendaraanController::class,'edit'])->name('kendaraan.edit');
    Route::put('/kendaraan/update/{id}',[KendaraanController::class,'update'])->name('kendaraan.update');
    Route::delete('/kendaraan/delete/{id}',[KendaraanController::class,'destroy'])->name('kendaraan.destroy');


    Route::get('/karyawan',[KaryawanController::class,'index'])->name('karyawan.index');
    Route::get('/karyawan/create',[KaryawanController::class,'create'])->name('karyawan.create');
    Route::post('/karyawan/store',[KaryawanController::class,'store'])->name('karyawan.store');
    Route::get('/karyawan/edit/{id}',[KaryawanController::class,'edit'])->name('karyawan.edit');
    Route::put('/karyawan/update/{id}',[KaryawanController::class,'update'])->name('karyawan.update');
    Route::delete('/karyawan/delete/{id}',[KaryawanController::class,'destroy'])->name('karyawan.destroy');
    
    Route::get('/order',[OrderController::class,'index'])->name('order.index');
    Route::get('/order/create',[OrderController::class,'create'])->name('order.create');
    Route::post('/order/store',[OrderController::class,'store'])->name('order.store');

    Route::get('/order/layanan/{kategori}',[OrderController::class,'getLayanan'])
        ->name('order.layanan');

    Route::get('/order/kendaraan/{pelanggan}',[OrderController::class,'getKendaraan'])
        ->name('order.kendaraan');

    Route::get('/order/{pelanggan}/kendaraan/create',[KendaraanController::class,'create'])
        ->name('order.kendaraan.create');

    Route::post('/order/{pelanggan}/kendaraan/store',[KendaraanController::class,'store'])
        ->name('order.kendaraan.store');

    Route::post('/order/scan',[OrderController::class,'scanQr'])
    ->name('order.scan');
    
    Route::get('/order/pelanggan/{id}',[OrderController::class,'getPelanggan'])->name('order.pelanggan');

    Route::get('/antrean',[AntreanController::class,'index'])->name('antrean.index');
    Route::put('/antrean/{antrean}/mulai',[AntreanController::class,'mulai'])->name('antrean.mulai');
    Route::put('/antrean/{antrean}/selesai-cuci',[AntreanController::class,'selesaiCuci'])->name('antrean.selesaiCuci');
    Route::put('/antrean/{antrean}/bayar',[AntreanController::class,'bayar'])->name('antrean.bayar');
    Route::get('/antrean/{antrean}/qris',[AntreanController::class,'generateQris'])->name('antrean.qris');

    Route::get('/stok',[StokController::class,'index'])->name('stok.index');
    Route::post('/stok/store',[StokController::class,'store'])->name('stok.store');
    Route::post('/stok/transaksi',[StokController::class,'transaksi'])->name('stok.transaksi');

    
});

Route::middleware(['auth','role:owner'])->prefix('owner')->name('owner.')->group(function(){

    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    Route::prefix('laporan')->name('laporan.')->group(function(){
        Route::get('/order',[LaporanController::class,'order'])
            ->name('order');

        Route::get('/stok',[LaporanController::class,'stok'])
            ->name('stok');
    });

    Route::get('/laporan/order/cetak',[LaporanController::class,'cetakOrder'])
    ->name('laporan.order.cetak');

    Route::get('/laporan/stok/cetak',[LaporanController::class,'cetakStok'])
    ->name('laporan.stok.cetak');

    Route::get('/profil-bisnis', [ProfilBisnisController::class, 'index'])->name('profil-bisnis.index');
    Route::put('/profil-bisnis', [ProfilBisnisController::class, 'update'])->name('profil-bisnis.update');


});