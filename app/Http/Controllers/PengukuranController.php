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

    public function getIndikatorNama(Request $request)
    {
        $bidangId = $request->input('bidang_id');

        try {
            $indikators = Indikator::where('id_bidang', $bidangId)
                ->select('id', 'indikator_nama')
                ->get();

            return response()->json($indikators);
        } catch (\Exception $e) {
            \Log::error('Gagal ambil indikator: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        }
    }
 
    public function getIndikatorByBidang($id_bidang)
    {
        $indikator = Indikator::where('id_bidang', $id_bidang)
            ->select('id', 'indikator_nama', 'sub_indikator')
            ->get();

        return response()->json($indikator);
    }

    public function getSubIndikatorByRumpun($rumpun)
    {
        $indikator = Indikator::where('id_bidang', $rumpun)->get();

        return response()->json($indikator);
    }

    

    public function store(Request $request)
    {
        $subIndikatorList = $request->input('sub_indikator_list');

        if (!is_array($subIndikatorList)) {
            return redirect()->back()->withErrors('Tidak ada data yang dikirim.');
        }

        $id_satker = session('id_satker');
        $tahun = session('tahun_terpilih');;

        $bulanMap = [
            'JANUARI' => 1,
            'FEBRUARI' => 2,
            'MARET' => 3,
            'APRIL' => 4,
            'MEI' => 5,
            'JUNI' => 6,
            'JULI' => 7,
            'AGUSTUS' => 8,
            'SEPTEMBER' => 9,
            'OKTOBER' => 10,
            'NOVEMBER' => 11,
            'DESEMBER' => 12,
        ];

        foreach ($subIndikatorList as $subIndikator) {
            $indikatorId = $request->input("indikator_id.$subIndikator");
            $ditanganiArray = $request->input("ditangani.$subIndikator", []);
            $diselesaikanArray = $request->input("diselesaikan.$subIndikator", []);

            // Ambil nilai sisa tahun lalu
            $sisaTahunLalu = $request->input("sisa_tahun_lalu.$subIndikator");
            $sisaTahunLalu = $sisaTahunLalu ? str_replace('.', '', str_replace(',', '.', $sisaTahunLalu)) : null;

            // Simpan sisa_tahun_lalu hanya sekali di bulan Januari
            if (!is_null($sisaTahunLalu)) {
                $pengukuran = \App\Models\Pengukuran::firstOrNew([
                    'indikator_id' => $indikatorId,
                    'id_satker' => $id_satker,
                    'tahun' => $tahun,
                    'sub_indikator' => $subIndikator,
                    'bulan' => 1,
                ]);

                $pengukuran->sisa_tahun_lalu = $sisaTahunLalu;
                $pengukuran->save();
            }

            foreach ($bulanMap as $bulanNama => $bulanAngka) {
                $ditangani = $ditanganiArray[$bulanNama] ?? null;
                $diselesaikan = $diselesaikanArray[$bulanNama] ?? null;

                // Lewati bulan yang kosong
                if (is_null($ditangani) && is_null($diselesaikan)) continue;

                // Bersihkan format angka
                $ditangani = $ditangani ? str_replace('.', '', str_replace(',', '.', $ditangani)) : null;
                $diselesaikan = $diselesaikan ? str_replace('.', '', str_replace(',', '.', $diselesaikan)) : null;

                $pengukuran = \App\Models\Pengukuran::firstOrNew([
                    'indikator_id' => $indikatorId,
                    'id_satker' => $id_satker,
                    'tahun' => $tahun,
                    'sub_indikator' => $subIndikator,
                    'bulan' => $bulanAngka,
                ]);

                $pengukuran->ditangani = $ditangani;
                $pengukuran->diselesaikan = $diselesaikan;
                $pengukuran->save();
            }
        }


        return redirect()->back()->with('success', 'Data pengukuran berhasil disimpan atau diperbarui.');
    }

    public function updateInline(Request $request)
    {
        $validated = $request->validate([
            'indikator_id' => 'required|integer',
            'sub_indikator' => 'required|string',
            'bulan' => 'required|integer|min:1|max:12',
            'tipe' => 'required|in:ditangani,diselesaikan',
            'nilai' => 'nullable|string',
        ]);

        $id_satker = session('id_satker');
        $tahun = date('Y');

        $pengukuran = Pengukuran::firstOrNew([
            'indikator_id' => $request->indikator_id,
            'id_satker' => $id_satker,
            'tahun' => $tahun,
            'sub_indikator' => $request->sub_indikator,
            'bulan' => $request->bulan,
        ]);

        $pengukuran->{$request->tipe} = $request->nilai;
        $pengukuran->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }

    public function getDataByBidangAndSubIndikator($id_bidang, $subIndikator)
    {
        $data = Pengukuran::whereHas('indikator', function ($query) use ($id_bidang) {
            $query->where('id_bidang', $id_bidang);
        })->where('sub_indikator', $subIndikator)
            ->select('bulan', 'ditangani', 'diselesaikan')
            ->get();

        return response()->json($data);
    }

    public function form($id)
    {
        $indikator = Indikator::findOrFail($id);
        return view('pengukuran.form_pengukuran', compact('indikator'));
    }

    public function getPengukuran($indikator_id)
    {
        $id_satker = session('id_satker');
        $data = Pengukuran::where('indikator_id', $indikator_id)->where('id_satker', $id_satker)->get([
            'sub_indikator',
            'bulan',
            'ditangani',
            'diselesaikan',
            'sisa_tahun_lalu'
        ]);

        return response()->json($data);
    }
}
