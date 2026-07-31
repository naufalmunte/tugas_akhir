@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('page-title', 'Dashboard')

@section('content')


    <div class="mt-2 rounded-xl bg-white p-6 shadow-sm">

        <h2 class="mb-3 text-lg font-semibold text-[#3A4163]">
            Selamat Datang
        </h2>

        <p class="leading-7 text-gray-600">
            Selamat datang Owner
        </p>

    </div>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 xl:grid-cols-3">

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
                        Rp {{ number_format($pendapatan, 0, ',', '.') }}
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

    <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-[#3A4163]">
                    Grafik Order
                </h2>
                <p class="text-sm text-gray-500">
                    Grafik jumlah order berdasarkan bulan.
                </p>
            </div>
            <select id="tahunFilter"
                class="rounded-lg border border-gray-300 px-4 py-2 focus:border-[#5AA8D6] focus:outline-none">
                @foreach ($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ $tahun == now()->year ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>
        </div>
        <canvas id="orderChart" height="90"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let chart;
        loadChart($('#tahunFilter').val());
        $('#tahunFilter').change(function() {
            loadChart($(this).val());
        });

        function loadChart(tahun) {
            $.get("{{ route('owner.dashboard.chart') }}", {
                tahun: tahun
            }, function(result) {
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(document.getElementById('orderChart'), {
                    type: 'line',
                    data: {
                        labels: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'Mei',
                            'Jun',
                            'Jul',
                            'Agu',
                            'Sep',
                            'Okt',
                            'Nov',
                            'Des'
                        ],

                        datasets: [{
                            label: 'Jumlah Order',
                            data: result,
                            borderColor: '#5AA8D6',
                            backgroundColor: 'rgba(90,168,214,.2)',
                            fill: true,
                            tension: .4
                        }]
                    },

                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
        }
    </script>

@endsection
