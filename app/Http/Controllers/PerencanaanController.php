<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perencanaan; // Ubah ke nama model baru
use App\Models\Renstra;
use App\Models\Iku;
use App\Models\Renja;
use App\Models\Rkakl;
use App\Models\Dipa;
use App\Models\Renaksi;
use App\Models\SinoriSakipPidum;
use App\Models\SinoriSakipIndikator;

class PerencanaanController extends Controller
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
        if ($tahun == "2024") {
            $id_periode = "P1";
        } else {
            $id_periode = "P2";
        }
        // Ambil data Renstra, IKU, Renja
        $renstra = Renstra::getData($id_satker, $id_periode);
        $iku = Iku::getData($id_satker, $tahun);
        $renja = Renja::getData($id_satker, $tahun);
        $rkakl = Rkakl::getData($id_satker, $tahun);
        $dipa = Dipa::getData($id_satker, $tahun);
        $renaksi = Renaksi::getData($id_satker, $tahun);
        $indikator = SinoriSakipIndikator::getData();
        // Panggil method untuk mendapatkan data target indikator
        $indikator_pidum = SinoriSakipPidum::getData($id_satker, $tahun); // Ubah setelah get() agar bisa menggunakan keyBy()

        // return view('perencanaan.input_indikator', compact('indikator', 'pidumTargets'));
        // );

        // dd ($indikator_pidum);
        // Kembalikan view beserta data yang telah difilter
        return view('kelola.perencanaan', ['renstra' => $renstra, 'iku' => $iku, 'renja' => $renja, 'tahun' => $tahun, 'rkakl' => $rkakl, 'dipa' => $dipa, 'renaksi' => $renaksi, 'indikator' => $indikator, 'indikator_pidum' => $indikator_pidum]);
    }

    // Fungsi untuk menangani upload file Renstra
    public function uploadRenstra(Request $request)
    {
        $tahun = session('tahun_terpilih');
        // Validasi file
        $request->validate([
            'renstra_file' => 'required|mimes:pdf|max:2048', // maksimal 2MB
        ]);

        if ($tahun == "2024") {
            $id_periode = "P1";
        } elseif ($tahun >= "2025" && $tahun <= "2029") {
            $id_periode = "P2";
        }

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestRenstra = Renstra::where('id_satker', $idSatker)
            ->where('id_periode', $id_periode)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestRenstra ? $latestRenstra->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/renstra
        $file = $request->file('renstra_file');
        $fileName = 'renstra_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf'; // Buat nama file
        $file->move(public_path('uploads/renstra'), $fileName); // Simpan di folder 'renstra' di public

        // Format tanggal upload ke d/m/y H:i:s
        $id_tglupload = now()->format('d/m/Y h:i A');


        // dd($id_periode);
        // Simpan data ke database
        Renstra::create([
            'id_satker' => $idSatker,
            'id_periode' => $id_periode, // Sesuaikan dengan data periode 2019 - 2024
            'id_perubahan' => $id_perubahan, // Simpan id_perubahan yang baru
            'id_filename' => $fileName,
            'id_tglupload' => $id_tglupload, // Simpan tanggal upload dengan format yang diinginkan
        ]);

        // return redirect()->route('perencanaan')->with('success', 'File Renstra berhasil diupload.')->with('active_tab', 'renstra');
        return redirect()->back()->with('success', 'Data berhasil disimpan!')->with('active_tab', 'renstra');
    }

    // Fungsi untuk menangani upload file Iku
    public function uploadIku(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'iku_file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestIku = Iku::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestIku ? $latestIku->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/iku
        $file = $request->file('iku_file');
        $fileName = 'IKU_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf';
        $file->move(public_path('uploads/iku'), $fileName);

        // Simpan data ke database
        Iku::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success', 'File IKU berhasil diupload.')->with('active_tab', 'iku');
    }

    // Fungsi untuk menangani upload file Renja
    public function uploadRenja(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'renja_file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestrenja = Renja::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestrenja ? $latestrenja->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/renja
        $file = $request->file('renja_file');
        $fileName = 'renja_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf';
        $file->move(public_path('uploads/renja'), $fileName);

        // Simpan data ke database
        Renja::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success', 'File renja berhasil diupload.')->with('active_tab', 'renja');
    }

    // Fungsi untuk menangani upload file Rkakl
    public function uploadRkakl(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'rkakl_file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestrkakl = Rkakl::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestrkakl ? $latestrkakl->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/rkakl
        $file = $request->file('rkakl_file');
        $fileName = 'rkakl_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf';
        $file->move(public_path('uploads/rkakl'), $fileName);

        // Simpan data ke database
        Rkakl::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success', 'File rkakl berhasil diupload.')->with('active_tab', 'rkakl');
    }

    // Fungsi untuk menangani upload file Dipa
    public function uploadDipa(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'dipa_file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);
        $id_pagu = $request->input('id_pagu');
        $id_gakyankum = $request->input('id_gakyankum');
        $id_dukman = $request->input('id_dukman');

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestdipa = Dipa::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestdipa ? $latestdipa->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/dipa
        $file = $request->file('dipa_file');
        $fileName = 'dipa_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf';
        $file->move(public_path('uploads/dipa'), $fileName);

        // Simpan data ke database
        Dipa::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_pagu' => $id_pagu,
            'id_gakyankum' => $id_gakyankum,
            'id_dukman' => $id_dukman,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success', 'File dipa berhasil diupload.')->with('active_tab', 'dipa');
    }

    // Fungsi untuk menangani upload file Dipa
    public function uploadRenaksi(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'renaksi_file' => 'required|mimes:pdf|max:2048', // Maksimal 2MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestrenaksi = Renaksi::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestrenaksi ? $latestrenaksi->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/renaksi
        $file = $request->file('renaksi_file');
        $fileName = 'renaksi_' . $id_perubahan . '_' . $idSatker . '_' . $tahun . '.pdf';
        $file->move(public_path('uploads/renaksi'), $fileName);

        // Simpan data ke database
        Renaksi::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success', 'File renaksi berhasil diupload.')->with('active_tab', 'renaksi');
    }

    public function store(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $idSatker = session('id_satker');

        // Validasi data input
        $validated = $request->validate([
            'id_indikator' => 'required|exists:sinori_sakip_indikator,id', // Pastikan indikator valid
            'target_indikator' => 'required|numeric',  //target_indikator 
            'indikator' => 'required|string', // Ambil dari view yang ditampilkan
        ]);

        // Tambahkan id_satker dan id_tahun ke dalam data yang tervalidasi
        $validated['id_satker'] = $idSatker;
        $validated['id_tahun'] = $tahun;

        // Cek apakah sudah ada data dengan kombinasi id_satker, id_indikator, dan id_tahun
        $existingRecord = SinoriSakipPidum::where('id_satker', $idSatker)
            ->where('id_indikator', $validated['id_indikator'])
            ->where('id_tahun', $tahun)
            ->first();

        if ($existingRecord) {
            // Jika sudah ada, update record yang ada
            $existingRecord->update([
                'target_indikator' => $validated['target_indikator'],
                'indikator' => $validated['indikator'],
            ]);
        } else {
            // Jika belum ada, simpan data baru
            SinoriSakipPidum::create($validated);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('perencanaan')->with('success', 'Data PK berhasil diinput!')->with('active_tab', 'perjanjian-kinerja');
    }

    // public function showIndikator()
    // {
    //     $idSatker = session('id_satker');

    //     // Ambil indikator PIDUM dan target_indikator yang ada
    //     $indikator_pidum = SinoriSakipIndikator::all()->map(function ($indikator) use ($idSatker) {
    //         $target = SinoriSakipPidum::where('id_satker', $idSatker)
    //             ->where('id_indikator', $indikator->id)
    //             ->first();

    //         $indikator->target_indikator = $target ? $target->target_indikator : null; // Simpan target jika ada
    //         return $indikator;
    //     });

    //     return view('perencanaan.indikator', compact('indikator_pidum'));
    // }
}
