@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pelanggan</p>
                <h2 class="text-3xl font-bold text-[#3A4163]">0</h2>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#CBE3EF] flex items-center justify-center">
                <i class="fa-solid fa-users text-2xl text-[#3A4163]"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Order Hari Ini</p>
                <h2 class="text-3xl font-bold text-[#3A4163]">0</h2>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#CBE3EF] flex items-center justify-center">
                <i class="fa-solid fa-cart-shopping text-2xl text-[#3A4163]"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Antrean Aktif</p>
                <h2 class="text-3xl font-bold text-[#3A4163]">0</h2>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#CBE3EF] flex items-center justify-center">
                <i class="fa-solid fa-list-check text-2xl text-[#3A4163]"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Karyawan</p>
                <h2 class="text-3xl font-bold text-[#3A4163]">0</h2>
            </div>
            <div class="w-14 h-14 rounded-full bg-[#CBE3EF] flex items-center justify-center">
                <i class="fa-solid fa-user-tie text-2xl text-[#3A4163]"></i>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-semibold text-[#3A4163] mb-4">Selamat Datang</h2>
    <p class="text-gray-600">Selamat datang di Sistem Informasi Manajemen Layanan Door Smeer Mobil CV. Kaemka Mitra Karya. Gunakan menu di sebelah kiri untuk mengelola data pelanggan, kendaraan, layanan, order, antrean, stok, dan laporan.</p>
</div>

@endsection