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

        // Ambil data Renstra, IKU, Renja
        $renstra = DB::table('sinori_sakip_renstra')
            ->where('id_satker', $id_satker)
            ->where('id_tahun', $tahun)
            ->get();
        $iku = DB::table('sinori_sakip_iku')
            ->where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->get();
        $renja = DB::table('sinori_sakip_renja')
            ->where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->get();
        $rkakl = DB::table('sinori_sakip_rkakl')
            ->where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->get();
        $dipa = DB::table('sinori_sakip_dipa')
            ->where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->get();
        $renaksi = DB::table('sinori_sakip_renaksi')
            ->where('id_satker', $id_satker)
            ->where('id_periode', $tahun)
            ->get();

        // Kembalikan view beserta data yang telah difilter
        return view('kelola.perencanaan', ['renstra' => $renstra, 'iku' => $iku, 'renja' => $renja, 'tahun' => $tahun, 'rkakl' => $rkakl, 'dipa' => $dipa, 'renaksi' => $renaksi]);
    }

    // Fungsi untuk menangani upload file Renstra
    public function uploadRenstra(Request $request)
    {
        $tahun = session('tahun_terpilih');
        // Validasi file
        $request->validate([
            'renstra_file' => 'required|mimes:pdf|max:2048', // maksimal 2MB
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek id_perubahan yang sudah ada
        $latestRenstra = Renstra::where('id_satker', $idSatker)
            ->where('id_tahun', $tahun)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
            ->first();

        // Tentukan id_perubahan
        $id_perubahan = $latestRenstra ? $latestRenstra->id_perubahan + 1 : 0;

        // Upload file ke folder public/uploads/renstra
        $file = $request->file('renstra_file');
        $fileName = 'renstra_' . $id_perubahan . '_' . $idSatker . '_' . $tahun .'.pdf'; // Buat nama file
        $file->move(public_path('uploads/renstra'), $fileName); // Simpan di folder 'renstra' di public

        // Format tanggal upload ke d/m/y H:i:s
        $id_tglupload = now()->format('d/m/Y h:i A');

        // Simpan data ke database
        Renstra::create([
            'id_satker' => $idSatker,
            'id_periode' => 'P1', // Sesuaikan dengan data periode 2019 - 2024
            'id_perubahan' => $id_perubahan, // Simpan id_perubahan yang baru
            'id_filename' => $fileName,
            'id_tglupload' => $id_tglupload, // Simpan tanggal upload dengan format yang diinginkan
            'id_tahun' => $tahun,
        ]);

        return redirect()->route('perencanaan')->with('success', 'File Renstra berhasil diupload.')->with('active_tab', 'renstra');
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
        $fileName = 'IKU_' . $id_perubahan . '_' . $idSatker . '_'. $tahun . '.pdf';
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
        $fileName = 'renja_' . $id_perubahan . '_' . $idSatker . '_'. $tahun . '.pdf';
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
        $fileName = 'rkakl_' . $id_perubahan . '_' . $idSatker . '_'. $tahun . '.pdf';
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
        $fileName = 'dipa_' . $id_perubahan . '_' . $idSatker . '_'. $tahun . '.pdf';
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
        $fileName = 'renaksi_' . $id_perubahan . '_' . $idSatker . '_'. $tahun . '.pdf';
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

}
