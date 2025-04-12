<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Lkjip;
class PelaporanController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        $idSatker = session('id_satker');
        // Ambil data dari database
        $lkjipFiles = Lkjip::where('id_periode', $tahun)
                            ->where('id_satker', $idSatker)
                            ->orderBy('id_perubahan', 'desc')
                            ->get();
                            
        return view('kelola.pelaporan', ['tahun' => $tahun, 'lkjipFiles' => $lkjipFiles]);
    }

    public function uploadLkjip(Request $request)
{
    $tahun = session('tahun_terpilih');
    $request->validate([
        'lkjip_file' => 'required|mimes:pdf|max:4096', // Max 4MB
        'triwulan' => 'required|in:1,2,3,4',
    ]);

    $idSatker = session('id_satker'); // Ambil id_satker dari session
    $triwulan = $request->input('triwulan');

    // Cek id_perubahan yang sudah ada
    $latestLkjip = Lkjip::where('id_satker', $idSatker)
        ->where('id_periode', $tahun)
        ->where('triwulan', $triwulan)
        ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc')
        ->first();

    // Tentukan id_perubahan
    $id_perubahan = $latestLkjip ? $latestLkjip->id_perubahan + 1 : 0;

    // Upload file ke folder public/uploads/lkjip
    $file = $request->file('lkjip_file');
    $fileName = $idSatker.'_lkjip_' . $tahun . '_' . $triwulan . '_' . $id_perubahan . '.pdf';
    $file->move(public_path('uploads/lkjip'), $fileName);

    // Simpan data ke database
    Lkjip::create([
        'id_satker' => $idSatker,
        'id_periode' => $tahun,
        'triwulan' => $triwulan,
        'id_perubahan' => $id_perubahan,
        'id_filename' => $fileName,
        'id_tglupload' => now(),
    ]);

    return redirect()->route('pelaporan')->with('success', 'File LKJiP berhasil diupload.')->with('active_tab', 'lkjip');
}


public function deleteLkjip($id)
{
    $file = Lkjip::findOrFail($id);

    // Hapus file dari storage
    $filePath = public_path('uploads/lkjip/' . $file->filename);
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Hapus dari database
    $file->delete();

    return redirect()->back()->with('success', 'File berhasil dihapus.');
}

}
