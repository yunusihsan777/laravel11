<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        // if (!session()->has('tahun_terpilih')) {
        //     return redirect()->route('pilih.tahun');
        // }

        // Set tahun_terpilih ke tahun sekarang jika belum ada di session
        $tahun = session('tahun_terpilih', date('Y'));
        session(['tahun_terpilih' => $tahun]);
        
        // Lanjutkan dengan logika untuk menampilkan data berdasarkan tahun
        // return view('dashboard', ['tahun' => $tahun]);

        $pengumuman = DB::table('sinori_sakip_inbox')->get();
        $jumlahAturan = DB::table('sinori_sakip_literasi')->count(); // Hitung jumlah aturan
        // Data untuk chart
        $data = [
            'pengisian_pk' => 80,
            'tw1' => 50,
            'tw2' => 50
        ];

        // Kirim data ke view
        // return view('dashboard', compact('pengumuman', 'jumlahAturan', 'data', ['tahun' => $tahun]));
        return view('dashboard', ['pengumuman' => $pengumuman, 'jumlahAturan' => $jumlahAturan, 'data' => $data,'tahun' => $tahun]);
    }
}
