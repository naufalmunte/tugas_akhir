<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Order</title>
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
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background: #f2f2f2;
        }

        .footer {
            margin-top: 40px;
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
    <h4>LAPORAN ORDER</h4>
    <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>
    @if (request('tanggal'))
        <p>Filter Tanggal : {{ \Carbon\Carbon::parse(request('tanggal'))->format('d-m-Y') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Karyawan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->pelanggan->nama }}</td>
                    <td>{{ $item->layanan->nama_layanan }}</td>
                    <td>{{ $item->karyawan->nama ?? '-' }}</td>
                    <td align="right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td align="center">{{ $item->antrean->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="right">Total Pendapatan</th>
                <th align="right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <div class="footer">
        <div class="ttd">
            <p>Padang, {{ now()->format('d F Y') }}</p>
            <br><br><br>
            <p><b>Owner</b></p>
        </div>
    </div>
</body>

</html>
