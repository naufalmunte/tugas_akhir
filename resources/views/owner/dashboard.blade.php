@extends('layouts.app')
@section('title', 'Dashboard Owner')
@section('page-title', 'Dashboard')

@section('content')
    <div class="mt-2 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-3 text-lg font-semibold text-[#3A4163]">
            Selamat Datang, Owner
        </h2>
        <p class="leading-7 text-gray-600">
            Pantau aktivitas operasional, pendapatan, transaksi, serta informasi penting lainnya melalui dashboard ini.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-3">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:col-span-2">
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
                            Pendapatan
                        </p>
                        <h2 class="mt-2 text-3xl font-bold text-[#3A4163]">
                            Rp {{ number_format($pendapatan, 0, ',', '.') }}
                        </h2>
                    </div>
                    <i class="fa-solid fa-wallet text-4xl text-green-500"></i>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex h-full flex-col">

                {{-- Header --}}
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">
                            Periode Gaji
                        </p>

                        <h2 class="mt-2 text-xl font-bold text-[#3A4163]">
                            {{ $namaBulanSekarang }} {{ $tahunSekarang }}
                        </h2>
                    </div>

                    <i class="fa-solid fa-calendar-check text-4xl text-[#5AA8D6]"></i>
                </div>

                <div class="mt-5">
                    @if ($periodeGajiSekarang)
                        <div class="rounded-lg border border-green-200 bg-green-50 p-3">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-green-600"></i>
                                <span class="text-sm font-medium text-green-700">
                                    Periode bulan ini sudah dibuat
                                </span>
                            </div>

                            <div class="mt-2 text-sm text-gray-600">
                                Pembagian karyawan:
                                <strong class="text-[#3A4163]">
                                    {{ number_format($periodeGajiSekarang->persentase_gaji, 0) }}%
                                </strong>
                            </div>

                            <div class="mt-1 text-sm text-gray-600">
                                Status:
                                <strong
                                    class="{{ $periodeGajiSekarang->status == 'Sudah Diproses' ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $periodeGajiSekarang->status }}
                                </strong>
                            </div>
                        </div>
                    @else
                        <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-3">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-yellow-700">
                                    Periode bulan ini belum dibuat
                                </span>
                            </div>

                            <p class="mt-2 text-xs text-gray-600">
                                Silakan tambahkan periode gaji
                                {{ $namaBulanSekarang }} {{ $tahunSekarang }}.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="mt-auto pt-4">
                    <a href="{{ route('owner.periode-gaji.index') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#5AA8D6] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#3A4163]">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        Kelola Periode Gaji
                    </a>
                </div>

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
