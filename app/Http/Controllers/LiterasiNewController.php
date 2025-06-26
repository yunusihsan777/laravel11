<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiterasiNewController extends Controller
{
    public function ViewLiterasiDashboard()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        return view('literasi', ['tahun' => $tahun]);
    }
}
