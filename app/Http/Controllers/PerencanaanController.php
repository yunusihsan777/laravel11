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
use App\Models\Bidang;
use App\Models\SinoriSakipPidum;
use App\Models\SinoriSakipIndikator;
use App\Models\TargetPK;
use App\Models\Pk;
use App\Models\SasaranProgram;
use App\Models\IndikatorKinerjaProgram;
use App\Models\TargetIkp;

class PerencanaanController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        $level = session('id_sakip_level');
        $satkernama = session('satkernama');
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        $khusus = session('tw4_khusus', false) ? 1 : 0;
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
        // $indikator = SinoriSakipIndikator::getData();
        $bidang = Bidang::where('id', $level)->where('bidang_nama', 'LIKE', '%' . $satkernama . '%')->get();
        // dd($bidang);
        // Panggil method untuk mendapatkan data target indikator 

        // $indicatorIds = [22, 23, 24, 25]; // Inisialisasi ID indikator di controller
        // $indikator_pidum = SinoriSakipPidum::getData($id_satker, $tahun, $indicatorIds);

        // Ambil data target berdasarkan indikator_id, id_satker, dan tahun
        $target = TargetPK::where('id_satker', $id_satker)
            ->where('tahun', $tahun)
            ->where('khusus', $khusus)
            ->get()
            ->keyBy('indikator_id'); // Agar mudah diakses di Blade
        // dd($bidang);
        // return view('perencanaan.input_indikator', compact('indikator', 'pidumTargets'));
        // );

        // Ambil data PK untuk satker & tahun
        $pk = Pk::where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->orderBy('id_perubahan', 'asc')
            ->get();

        // dd ($indikator_pidum);
        // Kembalikan view beserta data yang telah difilter
        return view('kelola.perencanaan', ['renstra' => $renstra, 'iku' => $iku, 'renja' => $renja, 'tahun' => $tahun, 'rkakl' => $rkakl, 'dipa' => $dipa, 'renaksi' => $renaksi, 'target' => $target, 'bidang' => $bidang, 'pk' => $pk]);
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

        // Upload file ke folder public/uploads/repository/renstra
        $file = $request->file('renstra_file');
        $fileName = 'renstra_' . $tahun . '_' . $id_perubahan . '.pdf'; // Buat nama file
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName); // Simpan di folder 'renstra' di public
        // $file->move(base_path('uploads/repository/renstra'), $fileName);
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
        return redirect()->back()->with('success-renstra', 'File Renstra berhasil disimpan!')->with('active_tab', 'renstra');
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

        // Upload file ke folder public/uploads/repository/iku
        $file = $request->file('iku_file');
        $fileName = 'IKU_' . $tahun . '_' . $id_perubahan . '.pdf';
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName);

        // Simpan data ke database
        Iku::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success-iku', 'File IKU berhasil diupload.')->with('active_tab', 'iku');
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

        // Upload file ke folder public/uploads/repository/renja
        $file = $request->file('renja_file');
        $fileName = 'renja_' . $tahun . '_' . $id_perubahan . '.pdf';
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName);

        // Simpan data ke database
        Renja::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success-renja', 'File renja berhasil diupload.')->with('active_tab', 'renja');
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

        // Upload file ke folder public/uploads/repository/rkakl
        $file = $request->file('rkakl_file');
        $fileName = 'rkakl_' . $tahun . '_' . $id_perubahan . '.pdf';
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName);

        // Simpan data ke database
        Rkakl::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success-rkakl', 'File rkakl berhasil diupload.')->with('active_tab', 'rkakl');
    }

    // Fungsi untuk menangani upload file Dipa
    public function uploadDipa(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Validasi input
        $request->validate([
            'dipa_file' => 'required|mimes:pdf|max:2048', // Maksimum 2MB, hanya PDF
            'id_pagu' => 'required|numeric',
            'id_gakyankum' => 'required|numeric',
            'id_dukman' => 'required|numeric',
        ]);

        // Ambil data perubahan terakhir dari tabel
        $latestdipa = Dipa::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Jika ada data sebelumnya, tambahkan +1 untuk id_perubahan, jika tidak mulai dari 0
        $id_perubahan = ($latestdipa && is_numeric($latestdipa->id_perubahan)) ? $latestdipa->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/repository/dipa
        try {
            $file = $request->file('dipa_file');
            $fileName = 'dipa_' . $tahun . '_' . $id_perubahan . '.pdf';
            $destinationPath = public_path('uploads/repository/' . $idSatker);

            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah file: ' . $e->getMessage());
        }

        // Simpan data ke database
        Dipa::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_pagu' => $request->input('id_pagu'),
            'id_gakyankum' => $request->input('id_gakyankum'),
            'id_dukman' => $request->input('id_dukman'),
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')
            ->with('success-dipa', 'File DIPA berhasil diupload.')
            ->with('active_tab', 'dipa');
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

        // Upload file ke folder public/uploads/repository/renaksi
        $file = $request->file('renaksi_file');
        $fileName = 'renaksi_' . $tahun . '_' . $id_perubahan . '.pdf';;
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName);

        // Simpan data ke database
        Renaksi::create([
            'id_satker' => $idSatker,
            'id_periode' => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename' => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success-renaksi', 'File renaksi berhasil diupload.')->with('active_tab', 'renaksi');
    }

    public function storetarget(Request $request)
{
    $request->validate([
        'indikator_id' => 'required|array',
        'indikator_id.*' => 'exists:sinori_sakip_indikator,id',
        'target_tahun' => 'required|array',
        'target_tahun.*' => 'nullable|numeric',
    ]);

    $id_satker = session('id_satker');
    $tahun = session('tahun_terpilih');
    $khusus = session('tw4_khusus');


    foreach ($request->indikator_id as $indikator_id) {

        $existingTarget = TargetPK::where('indikator_id', $indikator_id)
            ->where('id_satker', $id_satker)
            ->where('tahun', $tahun)
            ->where('khusus', $khusus)
            ->first();

        if ($existingTarget) {
            $existingTarget->update([
                'target_tahun' => $request->target_tahun[$indikator_id] ?? null,
                'khusus' => $khusus,
            ]);
        } else {
            TargetPK::create([
                'indikator_id' => $indikator_id,
                'id_satker' => $id_satker,
                'tahun' => $tahun,
                'khusus' => $khusus,
                'target_tahun' => $request->target_tahun[$indikator_id] ?? null,
            ]);
        }
    }

    return redirect()
        ->route('perencanaan')
        ->with('success-pk', 'Target berhasil disimpan!')
        ->with('active_tab', 'perjanjian-kinerja');
}


    // public function storetarget(Request $request)
    // {
    //     $request->validate([
    //         'indikator_id' => 'required|exists:sinori_sakip_indikator,id',
    //         'target_tahun' => 'required|numeric',
    //         // 'target_triwulan_1' => 'numeric',
    //         // 'target_triwulan_2' => 'numeric',
    //         // 'target_triwulan_3' => 'numeric',
    //         // 'target_triwulan_4' => 'numeric',
    //     ]);

    //     // Ambil session id_satker dan tahun
    //     $id_satker = session('id_satker');
    //     $tahun = session('tahun_terpilih');
    //     $khusus = session('tw4_khusus');
    //     // Cek apakah data sudah ada
    //     $existingTarget = TargetPK::where('indikator_id', $request->indikator_id)
    //         ->where('id_satker', $id_satker)
    //         ->where('tahun', $tahun)
    //         ->where('khusus', $khusus)
    //         ->first();

    //     if ($existingTarget) {
    //         // Jika sudah ada, update data
    //         $existingTarget->update([
    //             'target_tahun' => $request->target_tahun,
    //             // 'target_triwulan_1' => $request->target_triwulan_1,
    //             // 'target_triwulan_2' => $request->target_triwulan_2,
    //             // 'target_triwulan_3' => $request->target_triwulan_3,
    //             // 'target_triwulan_4' => $request->target_triwulan_4,
    //         ]);

    //         // return redirect()->back()->with('success', 'Target berhasil diperbarui!');
    //         return redirect()->route('perencanaan')->with('success-pk', 'Target berhasil diperbarui!')->with('active_tab', 'perjanjian-kinerja');
    //     }

    //     // Jika belum ada, buat data baru
    //     TargetPK::create([
    //         'indikator_id' => $request->indikator_id,
    //         'id_satker' => $id_satker,
    //         'tahun' => $tahun,
    //         'khusus' => $khusus,
    //         'target_tahun' => $request->target_tahun,
    //         // 'target_triwulan_1' => $request->target_triwulan_1,
    //         // 'target_triwulan_2' => $request->target_triwulan_2,
    //         // 'target_triwulan_3' => $request->target_triwulan_3,
    //         // 'target_triwulan_4' => $request->target_triwulan_4,
    //     ]);
    //     // return redirect()->back()->with('success', 'Target berhasil disimpan!');
    //     return redirect()->route('perencanaan')->with('success-pk', 'Target berhasil disimpan!')->with('active_tab', 'perjanjian-kinerja');
    // }

    // Fungsi untuk menangani upload file PK
    public function uploadPK(Request $request)
    {
        $tahun = session('tahun_terpilih');
        $request->validate([
            'pk_file' => 'required|mimes:pdf|max:5120', // Maksimal 5MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan terakhir
        $latestPK = Pk::where('id_satker', $idSatker)
            ->where('id_periode', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan baru
        $id_perubahan = $latestPK ? $latestPK->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/repository/{id_satker}
        $file = $request->file('pk_file');
        $fileName = 'pk_' . $tahun . '_' . $id_perubahan . '.pdf';
        $file->move(public_path('uploads/repository/' . $idSatker), $fileName);

        // Simpan ke database
        Pk::create([
            'id_satker'    => $idSatker,
            'id_periode'   => $tahun,
            'id_perubahan' => $id_perubahan,
            'id_filename'  => $fileName,
            'id_tglupload' => now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('perencanaan')->with('success-pk-file', 'File PK berhasil diupload!')->with('active_tab', 'perjanjian-kinerja');
    }

    /**
     * Mengambil data Sasaran Program & IKP beserta target untuk Perjanjian Kinerja Level 1
     */
    public function getTargetIkpData($idSatkerBidang, Request $request)
    {
        $tahun = session('tahun_terpilih', date('Y'));

        $sasaranPrograms = SasaranProgram::where('id_satker', $idSatkerBidang)
            ->where('tahun', $tahun)
            ->with(['indikatorKinerjaPrograms' => function ($q) use ($idSatkerBidang, $tahun) {
                $q->where('id_satker', $idSatkerBidang)->where('tahun', $tahun);
            }])
            ->get();

        $data = [];
        foreach ($sasaranPrograms as $sp) {
            $spItem = [
                'sp_id' => $sp->id,
                'kode_sp' => $sp->kode_sp,
                'nama_sp' => $sp->nama_sp,
                'ikps' => []
            ];

            foreach ($sp->indikatorKinerjaPrograms as $ikp) {
                $target = TargetIkp::where('ikp_id', $ikp->id)
                    ->where('id_satker', $idSatkerBidang)
                    ->where('tahun', $tahun)
                    ->first();

                $spItem['ikps'][] = [
                    'ikp_id' => $ikp->id,
                    'kode_ikp' => $ikp->kode_ikp,
                    'nama_ikp' => $ikp->nama_ikp,
                    'sifat_node' => $ikp->sifat_node,
                    'target_tahun' => $target && $target->target_tahun !== null ? (float)$target->target_tahun : null,
                    'target_tw1' => $target && $target->target_tw1 !== null ? (float)$target->target_tw1 : null,
                    'target_tw2' => $target && $target->target_tw2 !== null ? (float)$target->target_tw2 : null,
                    'target_tw3' => $target && $target->target_tw3 !== null ? (float)$target->target_tw3 : null,
                    'target_tw4' => $target && $target->target_tw4 !== null ? (float)$target->target_tw4 : null,
                ];
            }

            $data[] = $spItem;
        }

        return response()->json($data);
    }

    /**
     * Menyimpan target kinerja masing-masing IKP (Perjanjian Kinerja Level 1)
     */
    public function storeTargetIkp(Request $request)
    {
        $request->validate([
            'id_satker_bidang' => 'required',
            'targets' => 'required|array',
        ]);

        $idSatkerBidang = $request->input('id_satker_bidang');
        $tahun = session('tahun_terpilih', date('Y'));
        $targets = $request->input('targets', []);

        $cleanVal = function($val) {
            if ($val === null || $val === '') return null;
            $str = str_replace(',', '.', (string)$val);
            return is_numeric($str) ? (float)$str : null;
        };

        foreach ($targets as $ikpId => $tVals) {
            $ikp = IndikatorKinerjaProgram::find($ikpId);
            if (!$ikp) {
                continue;
            }

            $targetTahun = isset($tVals['target_tahun']) ? $cleanVal($tVals['target_tahun']) : null;
            $tw1 = isset($tVals['target_tw1']) && $tVals['target_tw1'] !== '' ? $cleanVal($tVals['target_tw1']) : $targetTahun;
            $tw2 = isset($tVals['target_tw2']) && $tVals['target_tw2'] !== '' ? $cleanVal($tVals['target_tw2']) : $targetTahun;
            $tw3 = isset($tVals['target_tw3']) && $tVals['target_tw3'] !== '' ? $cleanVal($tVals['target_tw3']) : $targetTahun;
            $tw4 = isset($tVals['target_tw4']) && $tVals['target_tw4'] !== '' ? $cleanVal($tVals['target_tw4']) : $targetTahun;

            TargetIkp::updateOrCreate(
                [
                    'ikp_id' => $ikp->id,
                    'id_satker' => $idSatkerBidang,
                    'tahun' => $tahun,
                ],
                [
                    'sp_id' => $ikp->sasaran_program_id,
                    'target_tahun' => $targetTahun,
                    'target_tw1' => $tw1,
                    'target_tw2' => $tw2,
                    'target_tw3' => $tw3,
                    'target_tw4' => $tw4,
                ]
            );
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Target Perjanjian Kinerja IKP berhasil disimpan!'
            ]);
        }

        return redirect()
            ->route('perencanaan')
            ->with('success-pk', 'Target Perjanjian Kinerja IKP berhasil disimpan!')
            ->with('active_tab', 'perjanjian-kinerja');
    }
}
