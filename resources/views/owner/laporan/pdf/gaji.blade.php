<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Gaji</title>
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
            text-align: left;
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
    <h4>LAPORAN GAJI KARYAWAN</h4>
    <p>Tanggal Cetak : {{ now()->format('d-m-Y H:i') }}</p>
    @if (request('periode'))
        <p>
            Periode :
            {{ optional($laporan->first()?->periodeGaji)->bulan }}
            {{ optional($laporan->first()?->periodeGaji)->tahun }}
        </p>
    @endif
    <div class="info">
        <div>
        <p>
            Total Karyawan :
            <b>{{ $laporan->count() }}</b>
        </p>
        <p>
            Total Order :
            <b>{{ $laporan->sum('jumlah_order') }}</b>
        </p>
        <p>
            Total Gaji :
            <b>
                Rp {{ number_format($laporan->sum('total_gaji'), 0, ',', '.') }}
            </b>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Karyawan</th>
                <th width="18%">Periode</th>
                <th width="15%">Jumlah Order</th>
                <th width="18%">Gaji / Order</th>
                <th width="20%">Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $item)
                <tr>
                    <td align="center">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->karyawan->nama }}
                    </td>
                    <td align="center">
                        {{ $item->periodeGaji->bulan }}
                        {{ $item->periodeGaji->tahun }}
                    </td>
                    <td align="center">
                        {{ $item->jumlah_order }}
                    </td>
                    <td align="right">
                        Rp {{ number_format($item->periodeGaji->gaji_per_order, 0, ',', '.') }}
                    </td>
                    <td align="right">
                        Rp {{ number_format($item->total_gaji, 0, ',', '.') }}
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
    </table>

    <div class="footer">
        <div class="ttd">
            <p>
                Padang, {{ now()->translatedFormat('d F Y') }}
            </p>
            <br><br><br>
            <p>
                <b>Owner</b>
            </p>
        </div>
    </div>
</body>

</html>
