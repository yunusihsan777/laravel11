<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LheAkip;
use App\Models\MonevRenaksi;
use App\Models\TlLheAkip;

class EvaluasiController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        $idSatker = session('id_satker');
        
        $lheAkipFiles = LheAkip::orderBy('id_tglupload', 'desc')->get();
        $lheAkipFiles = LheAkip::where('id_satker', $idSatker)
        ->where('id_periode', $tahun)
        ->orderBy('id_tglupload', 'desc')
        ->get();
    $tlLheAkipFiles = TLLheAkip::where('id_satker', $idSatker)
        ->where('id_periode', $tahun)
        ->orderBy('id_tglupload', 'desc')
        ->get();
        $monevRenaksiFiles = MonevRenaksi::where('id_periode', $tahun)
        ->where('id_satker', $idSatker)
        ->orderBy('id_perubahan', 'desc')
        ->get();
        return view('kelola.evaluasi', ['tahun' => $tahun,'lheAkipFiles' => $lheAkipFiles, 'monevRenaksiFiles' => $monevRenaksiFiles, 'tlLheAkipFiles' => $tlLheAkipFiles]);
    }

     // 📌 Upload LHE AKIP
     public function uploadLheAkip(Request $request)
     {
         $request->validate([
             'lhe_akip_file' => 'required|mimes:pdf|max:4096',
         ]);
         $tahun = session('tahun_terpilih');
         $idSatker = session('id_satker');
 
         // Cek id_perubahan yang sudah ada
         $latestLhe = LheAkip::where('id_satker', $idSatker)
             ->where('id_periode', $tahun)
             ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
             ->first();
 
         // Tentukan id_perubahan
         $id_perubahan = $latestLhe ? $latestLhe->id_perubahan + 1 : 0;
 
         // Upload file ke folder public/uploads/lkjip
         $file = $request->file('lhe_akip_file');
         $fileName = 'lhe_' . $tahun . '_' . $id_perubahan . '.pdf';
         $file->move(public_path('uploads/repository/'.$idSatker), $fileName);
 
         LheAkip::create([
             'id_periode' => $tahun,
             'id_satker' => $idSatker,
             'id_perubahan' => $id_perubahan,
             'id_filename' => $fileName,
             'id_tglupload' => now()->format('d/m/Y h:i A'),
 
         ]);
 
         return redirect()->route('evaluasi')->with(['success-lhe' => 'LHE AKIP berhasil diupload!','active_tab' => 'lhe-akip']);
     }
 
     public function uploadTlLheAkip(Request $request)
     {
         $request->validate([
             'tl_lhe_akip_file' => 'required|mimes:pdf|max:4096',
         ]);
 
         $tahun = session('tahun_terpilih');
         $idSatker = session('id_satker');
 
         // Cek versi terbaru
         $latestFile = TlLheAkip::where('id_satker', $idSatker)
             ->where('id_periode', $tahun)
             ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
             ->first();
 
         $id_perubahan = $latestFile ? $latestFile->id_perubahan + 1 : 0;
 
         if ($request->hasFile('tl_lhe_akip_file')) {
             $file = $request->file('tl_lhe_akip_file');
             $filename = 'tl_lhe_akip_' . $tahun . '_' . $id_perubahan . '.pdf';
             $file->move(public_path('uploads/repository/'.$idSatker), $filename);
 
             TlLheAkip::create([
                 'id_periode' => $tahun,
                 'id_satker' => $idSatker,
                 'id_perubahan' => $id_perubahan,
                 'id_filename' => $filename,
                 'id_tglupload' => now()->format('d/m/Y h:i A'),
 
             ]);
 
             return redirect()->route('evaluasi')->with(['success-tllhe' => 'File TL LHE AKIP berhasil diunggah.','active_tab' => 'tl-lhe-akip']);
         }
 
         return back()->with('error', 'Gagal mengunggah file.');
     }
 
     public function uploadMonevRenaksi(Request $request)
     {
         $request->validate([
             'id_triwulan' => 'required|in:TW 1,TW 2,TW 3,TW 4',
             'monev_file' => 'required|mimes:pdf|max:4096',
         ]);
 
         $tahun = session('tahun_terpilih');
         $idSatker = session('id_satker');
         $id_triwulan = $request->input('id_triwulan');
 
 
         $latestmonev = MonevRenaksi::where('id_satker', $idSatker)
             ->where('id_periode', $tahun)
             ->where('id_triwulan', $id_triwulan)
             ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
             ->first();
 
         $id_perubahan = $latestmonev ? $latestmonev->id_perubahan + 1 : 0;
         if ($request->hasFile('monev_file')) {
             $file = $request->file('monev_file');
             $filename = 'monev_' . $tahun . '_' . $id_perubahan . '_' . $id_triwulan . '.pdf';
             $file->move(public_path('uploads/repository/'.$idSatker), $filename);
 
             MonevRenaksi::create([
                 'id_periode' => $tahun,
                 'id_satker' => $idSatker,
                 'id_perubahan' => $id_perubahan,
                 'id_filename' => $filename,
                 'id_tglupload' => now()->format('d/m/Y h:i A'),
 
                 'id_triwulan' => $request->id_triwulan, // Simpan triwulan ke database
             ]);
             return redirect()->route('evaluasi')->with(['success-monev' => 'File Monev Renaksi berhasil diunggah.','active_tab' => 'monev-renaksi']);
         }
 
         return back()->with('error', 'Gagal mengunggah file.');
     }
}
