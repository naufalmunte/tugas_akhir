<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        h2,
        h4,
        p {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background: #f2f2f2;
        }

        .info {
            margin-top: 15px;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>DOOR SMEER MOBIL</h2>
    <h4>LAPORAN PENDAPATAN</h4>
    <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>

    @if (request('bulan'))
        <p>
            Periode :
            {{ \Carbon\Carbon::createFromFormat('Y-m', request('bulan'))->translatedFormat('F Y') }}
        </p>
    @endif

    <div class="info">

        <p>
            Total Order Selesai :
            <b>{{ $pendapatan->count() }}</b>
        </p>

        <p>
            Total Pendapatan :
            <b>
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </b>
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th width="5%">No</th>

                <th width="15%">
                    Tanggal
                </th>

                <th>
                    Pelanggan
                </th>

                <th>
                    Layanan
                </th>

                <th width="15%">
                    Metode
                </th>

                <th width="20%">
                    Pendapatan
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($pendapatan as $item)
                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td align="center">
                        {{ $item->created_at->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $item->pelanggan->nama }}
                    </td>

                    <td>
                        {{ $item->layanan->nama_layanan }}
                    </td>

                    <td align="center">
                        {{ $item->metode_pembayaran }}
                    </td>

                    <td align="right">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" align="center">
                        Tidak ada data.
                    </td>

                </tr>
            @endforelse

        </tbody>

        @if ($pendapatan->isNotEmpty())
            <tfoot>

                <tr>

                    <td colspan="5" align="right">

                        <b>Total Pendapatan</b>

                    </td>

                    <td align="right">

                        <b>
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </b>

                    </td>

                </tr>

            </tfoot>
        @endif

    </table>

    <div class="footer">

        <div class="ttd">

            <p>
                Padang,
                {{ now()->translatedFormat('d F Y') }}
            </p>

            <br><br><br>

            <p>
                <b>Owner</b>
            </p>

        </div>

    </div>

</body>

</html>
