<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absen_pm;
use App\Models\ba_pleno;
use App\Models\ba_praeval;
use Illuminate\Http\Request;
use App\Models\DataLke1;
use App\Models\Dipa;
use App\Models\Iku;
use App\Models\lhe_2023;
use App\Models\LheAkip;
use App\Models\lke_subkomponens;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use App\Models\lke_buktidukung;
use App\Models\Lkjip;
use App\Models\memo_datakinerja;
use App\Models\memo_lkjip;
use App\Models\MonevRenaksi;
use App\Models\nodis_eval_sakip;
use App\Models\nodis_p_sakip;
use App\Models\notulensi_pm;
use App\Models\Pk;
use App\Models\PokinRanwal;
use App\Models\Renaksi;
use App\Models\Renja;
use App\Models\Renstra;
use App\Models\reward_punish;
use App\Models\Rkakl;
use App\Models\sampel_rekom;
use App\Models\sample_skp;
use App\Models\sk_pk;
use App\Models\sk_pm;
use App\Models\tar_pm;
use App\Models\TlLheAkip;
use App\Models\tar_lkjip;
use App\Models\ss_perencanaan;
use App\Models\ss_laporanweb;
use App\Models\ss_laporanapp;
use App\Models\nodis_datakinerja;


class DataLke extends Controller
{
   public function index(){
      if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
      $sections = [
    'Perencanaan' => DataLke1::whereIn('subkomponen_id', [1, 2, 3])->get(),
    'Pengukuran'  => DataLke1::whereIn('subkomponen_id', [4, 5, 6])->get(),
    'Pelaporan'   => DataLke1::whereIn('subkomponen_id', [7, 8, 9])->get(),
    'Evaluasi'    => DataLke1::whereIn('subkomponen_id', [10, 11, 12])->get(),
    ];

       return view('kelola.components.evaluasi_lke', compact('sections', 'tahun'));
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
            $status = Iku::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
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
         }elseif ($id == 16) {
            // Cek di tabel renaksi
            $status = LheAkip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 17) {
            // Cek di tabel renaksi
            $status = TlLheAkip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';   
            }elseif ($id == 18) {
            // Cek di tabel renaksi
            $status = MonevRenaksi::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';   
            }elseif ($id == 19) {
            // Cek di tabel renaksi
            $status = MonevRenaksi::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';   
            }elseif ($id == 20) {
            // Cek di tabel renaksi
            $status= PokinRanwal::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 21) {
            // Cek di tabel renaksi
            $status=Renstra::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 22) {
            // cari tahun 2023
            $status=Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 23) {
            // cari tahun 2023
            $status=sample_skp::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 24) {
            $status=sk_pm::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 25) {
                $status=sk_pk::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 26) {
                $status=absen_pm::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 27) {
                //harusnya notulensi bimtek
                $status=notulensi_pm::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 28) {
                $status=nodis_p_sakip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 29) {
                $status=nodis_eval_sakip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 30) {
                $status=memo_datakinerja::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 31) {
                $status=nodis_datakinerja::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 32) {
                $status=reward_punish::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 33) {
                $status=sampel_rekom::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 34) {
                $status=ss_perencanaan::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 35) {
                $status=ss_laporanweb::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 36) {
                $status=ss_laporanapp::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 37) {
                //tw1
                $status=tar_lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';

            }elseif ($id == 38) {
                //tw2
                $status=tar_lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 39) {
                //tw1
                $status=memo_lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 40) {
                //tw2
                $status=memo_lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 41) {
                //tw1
                $status=tar_pm::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 42) {
                $status=ba_praeval::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 43) {
                $status=ba_pleno::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }elseif( $id == 44) {
                $status=lhe_2023::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
            }
        $bukti_dukung[] = [
            'nama' => $nama,
            'status' => $status
        ];
    }

    return view('kelola.components.cekbdeval_lke', compact('data1', 'bukti_dukung'));
}


}
