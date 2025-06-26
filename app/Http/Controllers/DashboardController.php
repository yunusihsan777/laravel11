<?php

namespace App\Http\Controllers;

use App\Models\Renstra;
use App\Models\Iku;
use App\Models\Renja;
use App\Models\Rkakl;
use App\Models\Dipa;
use App\Models\Inbox;
use App\Models\Renaksi;
use App\Models\Kep;
use App\Models\Literasi;
use Illuminate\Http\Request;
USE App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = session('tahun', date('Y'));
        session(['tahun' => $tahun]);

        $idSatker = session('tahun');
        if (!$idSatker) {
            return redirect()->route('pilih.tahun')->withErrors('ID Satker tidak ditemukan.');
        }

        $periode = 'P2';

        $pengumuman = Inbox::all();
        $jumlahAturan = Literasi::count();

/*         $data = [
            'pengisian_pk' => 80,
            'tw1' => 50,
            'tw2' => 50,
        ];
 */
        $user = Auth::user();
        $idSatker = $user->id_satker;
        $renstraTerisi = Renstra::where('id_satker', $idSatker)->where('id_periode', $periode)->exists();
        $ikuTerisi = Iku::where('id_satker', $idSatker)->where('id_periode', $tahun)->exists();
        $renjaTerisi = Renja::where('id_satker', $idSatker)->where('id_periode', $tahun)->exists();
        $rkaklTerisi = Rkakl::where('id_satker', $idSatker)->where('id_periode', $tahun)->exists();
        $dipaTerisi = Dipa::where('id_satker', $idSatker)->where('id_periode', $tahun)->exists();
        $rencanaAksiTerisi = Renaksi::where('id_satker', $idSatker)->where('id_periode', $tahun)->exists();
        $keputusanTimSakipTerisi = Kep::where('id_satker', $idSatker)->where('id_tahun', $tahun)->exists();

        return Inertia::render('dashboard', [
            'pengumuman' => $pengumuman,
            'jumlahAturan' => $jumlahAturan,
            'tahun' => $tahun,
            'renstraTerisi' => $renstraTerisi,
            'ikuTerisi' => $ikuTerisi,
            'renjaTerisi' => $renjaTerisi,
            'rkaklTerisi' => $rkaklTerisi,
            'dipaTerisi' => $dipaTerisi,
            'rencanaAksiTerisi' => $rencanaAksiTerisi,
            'keputusanTimSakipTerisi' => $keputusanTimSakipTerisi,
        ]);
    }
}
