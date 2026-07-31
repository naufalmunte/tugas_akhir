<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Order;
use App\Models\PeriodeGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeGajiController extends Controller
{
    public function index()
    {
        $periodeGaji = PeriodeGaji::with('gaji')
            ->oldest()
            ->paginate(10);

        return view('owner.periode_gaji.index', compact('periodeGaji'));
    }

    public function create()
    {
        return view('owner.periode_gaji.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => [
        'integer',
        'min:' . date('Y'),
        'max:' . (date('Y') + 10),
    ],
            'bulan' => 'required',
            'gaji_per_order' => 'required|numeric|min:1',
        ]);

        $cek = PeriodeGaji::where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Periode gaji sudah tersedia.');
        }

        PeriodeGaji::create([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'gaji_per_order' => $request->gaji_per_order,
            'status' => 'Belum Diproses',
        ]);

        return redirect()->route('owner.periode-gaji.index')
            ->with('success', 'Periode gaji berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periode = PeriodeGaji::findOrFail($id);

        if ($periode->status == 'Sudah Diproses') {
            return redirect()->route('owner.periode-gaji.index')
                ->with('error', 'Periode yang sudah diproses tidak dapat diubah.');
        }

        return view('owner.periode_gaji.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $periode = PeriodeGaji::findOrFail($id);

        if ($periode->status == 'Sudah Diproses') {
            return redirect()->route('owner.periode-gaji.index')
                ->with('error', 'Periode yang sudah diproses tidak dapat diubah.');
        }

        $request->validate([
            'tahun' => 'required|digits:4',
            'bulan' => 'required',
            'gaji_per_order' => 'required|numeric|min:1',
        ]);

        $periode->update([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'gaji_per_order' => $request->gaji_per_order,
        ]);

        return redirect()->route('owner.periode-gaji.index')
            ->with('success', 'Periode gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $periode = PeriodeGaji::findOrFail($id);

        if ($periode->status == 'Sudah Diproses') {
            return redirect()->route('owner.periode-gaji.index')
                ->with('error', 'Periode yang sudah diproses tidak dapat dihapus.');
        }

        $periode->delete();

        return redirect()->route('owner.periode-gaji.index')
            ->with('success', 'Periode gaji berhasil dihapus.');
    }

    public function proses($id)
    {
        $periode = PeriodeGaji::findOrFail($id);

        if ($periode->status == 'Sudah Diproses') {
            return back()->with('error', 'Periode gaji sudah diproses.');
        }

        DB::beginTransaction();

        try {

            $this->generateGaji($periode);

            $periode->update([
                'status' => 'Sudah Diproses',
            ]);

            DB::commit();

            return redirect()->route('owner.periode-gaji.index')
                ->with('success', 'Perhitungan gaji berhasil diproses.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $periode = PeriodeGaji::with('gaji.karyawan')->findOrFail($id);

        return view('owner.periode_gaji.show', compact('periode'));
    }

    private function generateGaji(PeriodeGaji $periode)
    {
        $bulan = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        $bulanAngka = $bulan[$periode->bulan];

        $orders = Order::whereYear('created_at', $periode->tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->whereNotNull('karyawan_id')
            ->whereHas('antrean', function ($query) {
                $query->where('status', 'Selesai');
            })
            ->get()
            ->groupBy('karyawan_id');

        foreach ($orders as $karyawanId => $dataOrder) {

            $jumlahOrder = $dataOrder->count();

            Gaji::create([
                'periode_gaji_id' => $periode->id,
                'karyawan_id' => $karyawanId,
                'jumlah_order' => $jumlahOrder,
                'total_gaji' => $jumlahOrder * $periode->gaji_per_order,
            ]);
        }
    }
}