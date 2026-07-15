@extends('layouts.app')

@section('title','Dashboard Owner')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-semibold text-gray-800">
        Dashboard Owner
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Ringkasan informasi sistem Door Smeer.
    </p>

</div>

<div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Pelanggan
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $totalPelanggan }}
                </h2>
            </div>
            <i class="fa-solid fa-users text-4xl text-[#5AA8D6]"></i>
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Total Order
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $totalOrder }}
                </h2>
            </div>
            <i class="fa-solid fa-cart-shopping text-4xl text-[#5AA8D6]"></i>
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Pendapatan
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    Rp {{ number_format($pendapatan,0,',','.') }}
                </h2>
            </div>
            <i class="fa-solid fa-wallet text-4xl text-green-500"></i>
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Order Hari Ini
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $orderHariIni }}
                </h2>
            </div>
            <i class="fa-solid fa-calendar-day text-4xl text-blue-500"></i>
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Antrean Aktif
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $antreanAktif }}
                </h2>
            </div>
            <i class="fa-solid fa-list-check text-4xl text-yellow-500"></i>
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Stok Menipis
                </p>
                <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                    {{ $stokMenipis }}
                </h2>
            </div>
            <i class="fa-solid fa-boxes-stacked text-4xl text-red-500"></i>
        </div>
    </div>

</div>

@endsection