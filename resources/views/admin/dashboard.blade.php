@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Baris 1 --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        {{-- Total Pelanggan --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pelanggan</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $totalPelanggan }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100">
                    <i class="fa-solid fa-users text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        {{-- Order Hari Ini --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Order Hari Ini</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $orderHariIni }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100">
                    <i class="fa-solid fa-cart-shopping text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        {{-- Proses Layanan Aktif --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Proses Layanan Aktif</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $prosesAktif }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-orange-100">
                    <i class="fa-solid fa-list-check text-2xl text-orange-600"></i>
                </div>
            </div>
        </div>

        {{-- Total Karyawan --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Karyawan</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $totalKaryawan }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-purple-100">
                    <i class="fa-solid fa-user-tie text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Baris 2 --}}
    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        {{-- Kendaraan Diproses --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Kendaraan Diproses</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $kendaraanDiproses }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-cyan-100">
                    <i class="fa-solid fa-soap text-2xl text-cyan-600"></i>
                </div>
            </div>
        </div>

        {{-- Kendaraan Menunggu --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Kendaraan Menunggu</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $kendaraanMenunggu }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-yellow-100">
                    <i class="fa-solid fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        {{-- Order Karpet Aktif --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Order Karpet Aktif</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $karpetAktif }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-amber-100">
                    <i class="fa-solid fa-rug text-2xl text-amber-700"></i>
                </div>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Stok Menipis</p>
                    <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                        {{ $stokMenipis }}
                    </h2>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                    <i class="fa-solid fa-box-open text-2xl text-red-600"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Informasi --}}
    <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">

        <h2 class="mb-3 text-lg font-semibold text-[#3A4163]">
            Selamat Datang
        </h2>

        <p class="leading-7 text-gray-600">
           Selamat datang admin
        </p>

    </div>

@endsection
