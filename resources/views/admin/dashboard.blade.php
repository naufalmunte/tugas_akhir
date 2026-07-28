@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="mt-2 rounded-xl bg-white p-6 shadow-sm">

        <h2 class="mb-3 text-lg font-semibold text-[#3A4163]">
            Selamat Datang
        </h2>

        <p class="leading-7 text-gray-600">
            Selamat datang admin
        </p>

    </div>
    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
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

    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
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
            $.get("{{ route('admin.dashboard.chart') }}", {
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
