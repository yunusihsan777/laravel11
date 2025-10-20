<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;
use App\Models\Pengukuran;

class PengukuranController extends Controller
{
    public function index(Request $request)
    {
        $id_bidang = $request->get('id_bidang');
        $tahun = session('tahun_terpilih');
        $id_satker = session('id_satker');

        $indikators = [];
        $data = [];

        if ($id_bidang) {
            $indikators = Indikator::where('id_bidang', $id_bidang)->get();

            foreach ($indikators as $indikator) {
                $subIndikators = explode(',', $indikator->sub_indikator);
                $pengukuranData = Pengukuran::where('indikator_id', $indikator->id)
                    ->where('id_satker', $id_satker)
                    ->where('tahun', $tahun)
                    ->get();

                $data[$indikator->id] = [
                    'nama' => $indikator->indikator_nama,
                    'sub' => []
                ];

                foreach ($subIndikators as $sub) {
                    $sub = trim($sub);
                    $data[$indikator->id]['sub'][$sub] = $pengukuranData
                        ->where('sub_indikator', $sub)
                        ->where('id_satker', $id_satker)
                        ->keyBy('bulan'); // <--- agar mudah akses berdasarkan bulan
                }
            }
        }

        return view('kelola.pengukuran', compact('data', 'indikators', 'tahun'));
    }

    //     public function getIndikatorNama(Request $request)
    //     {
    //         $bidangId = $request->input('bidang_id');

    //         try {
    //             $indikators = Indikator::where('id_bidang', $bidangId)
    //                 ->select('id', 'indikator_nama')
    //                 ->get();

    //             return response()->json($indikators);
    //         } catch (\Exception $e) {
    //             \Log::error('Gagal ambil indikator: ' . $e->getMessage());
    //             return response()->json(['error' => 'Gagal mengambil data'], 500);
    //         }
    //     }
    //  public function getDataByBidangAndSubIndikator($id_bidang, $subIndikator)
    //     {
    //         $data = Pengukuran::whereHas('indikator', function ($query) use ($id_bidang) {
    //             $query->where('id_bidang', $id_bidang);
    //         })->where('sub_indikator', $subIndikator)
    //             ->select('bulan', 'ditangani', 'diselesaikan')
    //             ->get();

    //         return response()->json($data);
    //     }

  public function store(Request $request)
{
    $subIndikatorList = $request->input('sub_indikator_list');

    if (!is_array($subIndikatorList)) {
        return redirect()->back()->withErrors('Tidak ada data yang dikirim.');
    }

    $id_satker = session('id_satker');
    $tahun     = session('tahun_terpilih');

    $bulanMap = [
        'JANUARI' => 1, 'FEBRUARI' => 2, 'MARET' => 3, 'APRIL' => 4,
        'MEI' => 5, 'JUNI' => 6, 'JULI' => 7, 'AGUSTUS' => 8,
        'SEPTEMBER' => 9, 'OKTOBER' => 10, 'NOVEMBER' => 11, 'DESEMBER' => 12,
    ];

    $triwulanMap = [
        'TW1' => [3],
        'TW2' => [6],
        'TW3' => [9],
        'TW4' => [12],
    ];

    // helper lokal untuk normalisasi angka
    $normalizeNumber = function ($val) {
        if ($val === null || $val === '' || $val === '-') {
            return null;
        }
        // hilangkan pemisah ribuan, ubah koma jadi titik (desimal)
        $val = str_replace('.', '', $val);
        $val = str_replace(',', '.', $val);
        return (float) $val;
    };

    foreach ($subIndikatorList as $subIndikator) {
        $indikatorId = $request->input("indikator_id.$subIndikator");
        $indikator   = Indikator::find($indikatorId);

        if (!$indikator) {
            continue; // skip kalau tidak valid
        }

        // === Simpan Sisa Tahun Lalu (kalau ada) ===
        $sisaTahunLalu = $normalizeNumber($request->input("sisa_tahun_lalu.$subIndikator"));

        $pengukuranSisa = \App\Models\Pengukuran::firstOrNew([
            'indikator_id'  => $indikatorId,
            'id_satker'     => $id_satker,
            'tahun'         => $tahun,
            'sub_indikator' => $subIndikator,
            'bulan'         => 1, // Januari
        ]);
        $pengukuranSisa->sisa_tahun_lalu = $sisaTahunLalu;
        $pengukuranSisa->save();

        // === Proses Bulanan ===
        $labels = [];
        if (!empty($indikator->indikator_penghitungan)) {
            $labels = array_map('trim', explode(',', strtolower($indikator->indikator_penghitungan)));
        }
        if (empty($labels)) {
            $labels = ['ditangani', 'diselesaikan'];
        }

        foreach ($bulanMap as $bulanNama => $bulanAngka) {
            $values = [];

            foreach ($labels as $label) {
                $val = $normalizeNumber($request->input("$label.$subIndikator.$bulanNama"));
                $values[] = $val;
            }

            // gabungkan dengan ;
            $capaian = implode(';', array_map(fn($v) => $v ?? '', $values));

            $pengukuran = \App\Models\Pengukuran::firstOrNew([
                'indikator_id'  => $indikatorId,
                'id_satker'     => $id_satker,
                'tahun'         => $tahun,
                'sub_indikator' => $subIndikator,
                'bulan'         => $bulanAngka,
            ]);
            $pengukuran->perhitungan = $capaian !== '' ? $capaian : null;

            if ($bulanAngka == 1) {
                $pengukuran->sisa_tahun_lalu = $sisaTahunLalu;
            }
            $pengukuran->save();
        }

        // === Proses Triwulan ===
        foreach ($triwulanMap as $tw => $bulanList) {
            foreach ($labels as $label) {
                $nilai = $normalizeNumber($request->input("$label.$subIndikator.$tw"));

                foreach ($bulanList as $bulanAngka) {
                    $pengukuran = \App\Models\Pengukuran::firstOrNew([
                        'indikator_id'  => $indikatorId,
                        'id_satker'     => $id_satker,
                        'tahun'         => $tahun,
                        'sub_indikator' => $subIndikator,
                        'bulan'         => $bulanAngka,
                    ]);
                    $pengukuran->capaian = $nilai; // jika $nilai null → akan overwrite ke null
                    $pengukuran->save();
                }
            }
        }
    }

    return redirect()->back()->with('success', 'Data pengukuran berhasil disimpan atau diperbarui.');
}


    // public function updateInline(Request $request)
    // {
    //     $validated = $request->validate([
    //         'indikator_id' => 'required|integer',
    //         'sub_indikator' => 'required|string',
    //         'bulan' => 'required|integer|min:1|max:12',
    //         'tipe' => 'required|in:ditangani,diselesaikan',
    //         'nilai' => 'nullable|string',
    //     ]);

    //     $id_satker = session('id_satker');
    //     $tahun = date('Y');

    //     $pengukuran = Pengukuran::firstOrNew([
    //         'indikator_id' => $request->indikator_id,
    //         'id_satker' => $id_satker,
    //         'tahun' => $tahun,
    //         'sub_indikator' => $request->sub_indikator,
    //         'bulan' => $request->bulan,
    //     ]);

    //     $pengukuran->{$request->tipe} = $request->nilai;
    //     $pengukuran->save();

    //     return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    // }


    public function form($id)
    {
        $indikator = Indikator::findOrFail($id);
        return view('pengukuran.form_pengukuran', compact('indikator'));
    }

    public function getPengukuran($indikatorId)
    {
        $idSatker = auth()->user()->id_satker;

        $pengukuran = \App\Models\Pengukuran::where('indikator_id', $indikatorId)
            ->where('id_satker', $idSatker)
            ->get(['sub_indikator', 'bulan', 'perhitungan', 'sisa_tahun_lalu', 'capaian']);

        return response()->json($pengukuran);
    }

    public function getSubindikator($rumpun)
    {
        $tahun = date('Y');
        $level = session('id_sakip_level');

        $indikators = Indikator::where('link', $rumpun)
            ->where(function ($query) use ($tahun) {
                $query->where('tahun', 'LIKE', "%$tahun%");
            })
            ->where(function ($query) use ($level) {
                if ($level == 1) {
                    $query->whereIn('lingkup', [0, 1]);
                } elseif ($level == 2) {
                    $query->whereIn('lingkup', [0, 2, 5, 7]);
                } elseif ($level == 3) {
                    $query->whereIn('lingkup', [0, 3, 5, 6, 7]);
                } elseif ($level == 4) {
                    $query->whereIn('lingkup', [0, 4, 6]);
                }
            })
            ->get();

        return response()->json($indikators);
    }
}
