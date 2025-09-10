<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLke1;
use App\Models\Dipa;
use App\Models\Iku;
use App\Models\LheAkip;
use App\Models\lke_subkomponens;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use App\Models\lke_buktidukung;
use App\Models\Lkjip;
use App\Models\Pk;
use App\Models\Renaksi;
use App\Models\Renja;
use App\Models\Renstra;
use App\Models\Rkakl;

class DataLke extends Controller
{
   public function index(){
      if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
      $data1 = DataLke1::whereIn('subkomponen_id', [1, 2, 3])->get();
      
       return view('kelola.components.evaluasi_lke', compact('data1', 'tahun'));
   }
   public function cekBuktiDukung($kode){
   
    $data1 = DataLke1::where('kode', $kode)->get();
    // Ambil semua kode_bukti, pecah jadi array angka
    $kodeBuktiIds = [];
    foreach ($data1 as $item) {
        $ids = explode(',', $item->kode_bukti);
        foreach ($ids as $id) {
            $kodeBuktiIds[] = (int)trim($id);
        }
    }

    // Ambil nama dokumen dari lke_buktidukung
    $bukti_dukung_nama = lke_buktidukung::whereIn('id', $kodeBuktiIds)->pluck('dokumen', 'id');

    // Siapkan array hasil
    $bukti_dukung = [];
    foreach ($kodeBuktiIds as $id) {
        $nama = $bukti_dukung_nama[$id] ?? '-';
        $status = 'Tidak Ada';

        if ($id == 1) {
            $status = Renstra::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        } elseif ($id == 2) {
            $status = Renja::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        } elseif ($id == 3) {
            $status = Renaksi::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 4) {
            // Cek di tabel renaksi
            $status = Rkakl::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 5) {
            // Cek di tabel renaksi
            $status = Dipa::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        } elseif($id == 6) {
            // Cek di tabel renaksi
            $status = Pk::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 7) {
            // Cek di tabel renaksi
            $status = Pk::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 8) {
            // Cek di tabel renaksi
            $status = Iku::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 9) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 10) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 11) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 12) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 13) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 14) {
            // Cek di tabel renaksi
            $status = LheAkip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 15) {
            // Cek di tabel renaksi
            $status = LheAkip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }

        $bukti_dukung[] = [
            'nama' => $nama,
            'status' => $status
        ];
    }

    return view('kelola.components.cekbdeval_lke', compact('data1', 'bukti_dukung'));
}

   public function lke2(){
      $data2 = DataLke1::where('subkomponen_id', [4, 5, 6])->get();
      return view('lke2', compact('data2'));
   }
   public function lke3(){
      $data3 = DataLke1::where('subkomponen_id', [7, 8, 9])->get();
      return view('lke3', compact('data3'));
   }
   public function lke4(){
      $data4 = DataLke1::where('subkomponen_id', [10, 11, 12])->get();
      return view('lke4', compact('data4'));
   }


}
