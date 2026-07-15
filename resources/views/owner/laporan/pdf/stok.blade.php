<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Stok</title>
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
    <h4>LAPORAN AKTIVITAS STOK</h4>
    <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>
    @if (request('tanggal'))
        <p>Filter Tanggal : {{ \Carbon\Carbon::parse(request('tanggal'))->format('d-m-Y') }}</p>
    @endif
    @if (request('bulan'))
        <p>Filter Bulan : {{ \Carbon\Carbon::parse(request('bulan') . '-01')->translatedFormat('F Y') }}</p>
    @endif
    <div class="info">
        <p>Total Transaksi Masuk : <b>{{ $stok->where('jenis', 'Masuk')->count() }}</b></p>
        <p>Total Transaksi Keluar : <b>{{ $stok->where('jenis', 'Keluar')->count() }}</b></p>
    </div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="18%">Tanggal</th>
                <th>Barang</th>
                <th width="12%">Jenis</th>
                <th width="12%">Jumlah</th>
                <th width="12%">Stok Saat Ini</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stok as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $item->stok->nama_barang }}</td>
                    <td align="center">{{ $item->jenis }}</td>
                    <td align="center">{{ $item->jumlah }} {{ $item->stok->satuan }}</td>
                    <td align="center">{{ $item->stok->stok }} {{ $item->stok->satuan }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">
        <div class="ttd">
            <p>Padang, {{ now()->translatedFormat('d F Y') }}</p>
            <br><br><br>
            <p><b>Owner</b></p>
        </div>
    </div>
</body>

</html>
