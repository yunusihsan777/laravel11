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
        $validated = $request->validate([
            'id_indikator' => 'required|exists:sinori_sakip_pidum,id',
            'bulan' => 'required|integer|min:1|max:12',
            'ditangani' => 'required|integer',
            'diselesaikan' => 'required|integer',
            'faktor' => 'required|string',
            'upaya' => 'required|string',
        ]);

        // Menyimpan data ke tabel sinori_sakip_pidum_detail
        SinoriSakipPidumDetail::create([
            'id' => $validated['id_indikator'],
            'id_satker' => session('id_satker'),
            'indikator' => SinoriSakipPidum::find($validated['id_indikator'])->indikator_nama,
            'bulan' => $validated['bulan'],
            'ditangani' => $validated['ditangani'],
            'diselesaikan' => $validated['diselesaikan'],
            'faktor' => $validated['faktor'],
            'upaya' => $validated['upaya'],
            'created_at' => now()->format('d/m/Y H:i A'),
            'updated_at' => now()->format('d/m/Y H:i A'),
        ]);

        return redirect()->route('pengukuran')->with('success', 'Data berhasil disimpan');
    }
}
