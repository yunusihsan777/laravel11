<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AturanController extends Controller
{
    public function index()
    {
        $aturan = DB::table('sinori_sakip_literasi') // Atau gunakan model jika ada
        ->orderBy('id_tahun', 'asc') // Urutkan berdasarkan kolom 'id_tahun'
        ->get();
        return view('aturan', compact('aturan'));
        
    }
}
