<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\PelangganController;


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
    
});

Route::middleware(['auth','role:owner'])->prefix('owner')->name('owner.')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');
    
});