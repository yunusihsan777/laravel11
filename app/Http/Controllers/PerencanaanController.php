<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel sinori_sakip_renstra
        // Ambil nilai id_satker dari session
        $id_satker = session('id_satker');

        // Ambil data dari tabel sinori_sakip_renstra dengan kondisi where id_satker
        $renstra = DB::table('sinori_sakip_renstra')
            ->where('id_satker', $id_satker)
            ->get();

        // Kembalikan view beserta data yang telah difilter
        return view('kelola.perencanaan', compact('renstra'));
    }
}
