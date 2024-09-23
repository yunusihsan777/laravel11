<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Menerapkan middleware di seluruh metode controller
    // }

    public function index()
    {
        $pengumuman = DB::table('sinori_sakip_inbox')->get();
        $jumlahAturan = DB::table('sinori_sakip_literasi')->count(); // Hitung jumlah aturan
        // Data untuk chart
        $data = [
            'pengisian_pk' => 80,
            'tw1' => 50,
            'tw2' => 50
        ];

        // Kirim data ke view
        return view('dashboard', compact('pengumuman', 'jumlahAturan', 'data'));
    }
}
