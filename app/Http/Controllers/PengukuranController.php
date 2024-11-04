<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinoriSakipPidum;
use App\Models\SinoriSakipPidumDetail;
use Illuminate\Support\Facades\DB;

class PengukuranController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        // Ambil nilai id_satker dari session
        $id_satker = session('id_satker');
        $indicatorIds = [22, 23, 24, 25]; // Inisialisasi ID indikator di controller
        $indikator_pidum = SinoriSakipPidum::getData($id_satker, $tahun, $indicatorIds);

        // Ambil data dari tabel sinori_sakip_pidum dan sinori_sakip_indikator yang digabungkan
        $indikators = DB::table('sinori_sakip_pidum')
            ->join('sinori_sakip_indikator', 'sinori_sakip_pidum.id_indikator', '=', 'sinori_sakip_indikator.id')
            ->where('sinori_sakip_pidum.id_satker', $id_satker)
            ->where('sinori_sakip_pidum.id_tahun', $tahun)
            ->whereIn('sinori_sakip_pidum.id_indikator', $indicatorIds)
            ->select('sinori_sakip_pidum.*', 'sinori_sakip_indikator.*')
            ->get();
        // dd($indikators);
        // Proses data untuk memisahkan nilai matrix berdasarkan tanda titik (.)
        foreach ($indikators as $indikator) {
            $matrix_parts = explode(',', $indikator->matrix);

            // Cek jika ada lebih dari satu bagian setelah pemisahan
            if (count($matrix_parts) > 1) {
                $indikator->before_dot = $matrix_parts[0]; // Sebelum titik
                $indikator->after_dot = $matrix_parts[1];  // Setelah titik
            } else {
                $indikator->before_dot = $indikator->matrix; // Tidak ada titik
                $indikator->after_dot = null;  // Kosongkan jika tidak ada
            }
        }

        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        // dd($indikator_pidum);
        return view('kelola.pengukuran', ['tahun' => $tahun, 'indikator_pidum' => $indikator_pidum, 'indikator' => $indikator, 'indikators' => $indikators]);
    }

    public function store(Request $request)
{
    $bulan = $request->input('bulan');
    $idSatker = session('id_satker');
    $tahun = session('tahun_terpilih');
    $idIndikator = $request->input('id_indikator');
    if (is_null($bulan)) {
        return redirect()->back()->withErrors(['bulan' => 'Bulan tidak ditemukan.']);
    }
    // Mengambil indikator spesifik berdasarkan id_indikator yang disubmit
    $indikator = DB::table('sinori_sakip_pidum')
        ->join('sinori_sakip_indikator', 'sinori_sakip_pidum.id_indikator', '=', 'sinori_sakip_indikator.id')
        ->where('sinori_sakip_pidum.id_satker', $idSatker)
        ->where('sinori_sakip_pidum.id_tahun', $tahun)
        ->where('sinori_sakip_pidum.id_indikator', $idIndikator)
        ->select('sinori_sakip_pidum.*', 'sinori_sakip_indikator.*')
        ->first();

    if ($indikator) {
        // Update atau Insert
        $existingData = SinoriSakipPidumDetail::where([
            'id' => $idIndikator,
            'id_satker' => $idSatker,
            'bulan' => $bulan,
        ])->first();

        $data = [
            'ditangani' => $request->input('ditangani_before', 0) + $request->input('ditangani_after', 0),
            'diselesaikan' => $request->input('diselesaikan_before', 0) + $request->input('diselesaikan_after', 0),
            'faktor' => $request->input('faktor'),
            'upaya' => $request->input('upaya'),
            'updated_at' => now(),
        ];

        if ($existingData) {
            $existingData->update($data);
        } else {
            $data = array_merge($data, [
                'id' => $idIndikator,
                'id_satker' => $idSatker,
                'matrix' => $indikator->indikator,
                'bulan' => $bulan,
                'created_at' => now(),
            ]);
            SinoriSakipPidumDetail::create($data);
        }
    }

    return redirect()->route('pengukuran')->with('success', 'Data berhasil disimpan');
}



}
