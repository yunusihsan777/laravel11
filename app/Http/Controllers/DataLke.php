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
   private function getMapping()
{
    return [
        1 => Renstra::class,
        2 => Renja::class,
        3 => Renaksi::class,
        4 => Rkakl::class,
        5 => Dipa::class,
        6 => Pk::class,
        7 => Pk::class,
        8 => Iku::class,
        9 => Iku::class,
        10 => Lkjip::class,
        11 => Lkjip::class,
        12 => Lkjip::class,
        13 => 'sinori_sakip_rastaff',
        14 => 'sinori_sakip_rastaff',
        15 => LheAkip::class,
        16 => LheAkip::class,
        17 => TlLheAkip::class,
        18 => MonevRenaksi::class,
        19 => MonevRenaksi::class,
        20 => PokinRanwal::class,
        21 => Renstra::class,
        22 => Lkjip::class,
        23 => sample_skp::class,
        24 => sk_pm::class,
        25 => sk_pk::class,
        26 => absen_pm::class,
        27 => notulensi_pm::class,
        28 => nodis_p_sakip::class,
        29 => nodis_eval_sakip::class,
        30 => memo_datakinerja::class,
        31 => nodis_datakinerja::class,
        32 => reward_punish::class,
        33 => sampel_rekom::class,
        34 => ss_perencanaan::class,
        35 => ss_laporanweb::class,
        36 => ss_laporanapp::class,
        37 => tar_lkjip::class,
        38 => tar_lkjip::class,
        39 => memo_lkjip::class,
        40 => memo_lkjip::class,
        41 => tar_pm::class,
        42 => ba_praeval::class,
        43 => ba_pleno::class,
        44 => lhe_2023::class,
    ];
}

   public function cekBuktiDukung($kode){
   if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
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
            $status = Lkjip::where('id_satker', '006050')->where('triwulan', 'TW 1')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 11) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->where('triwulan', 'TW 2')->exists() ? 'Ada' : 'Tidak Ada';
        }elseif ($id == 12) {
            // Cek di tabel renaksi
            $status = Lkjip::where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 13) {
            // Cek di tabel renaksi
            $status = DB::table('sinori_sakip_rastaff')->where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
         }elseif ($id == 14) {
            // Cek di tabel renaksi
            $status = DB::table('sinori_sakip_rastaff')->where('id_satker', '006050')->exists() ? 'Ada' : 'Tidak Ada';
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
            $status=Lkjip::where('id_satker', '006050')->where('tahun', 2023)->exists() ? 'Ada' : 'Tidak Ada';
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
                $status=tar_lkjip::where('id_satker', '006050')->where('TW', 1)->exists() ? 'Ada' : 'Tidak Ada';

            }elseif ($id == 38) {
                //tw2
                $status=tar_lkjip::where('id_satker', '006050')->where('TW', 2)->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 39) {
                //tw1
                $status=memo_lkjip::where('id_satker', '006050')->where('TW', 1)->exists() ? 'Ada' : 'Tidak Ada';
            }elseif ($id == 40) {
                //tw2
                $status=memo_lkjip::where('id_satker', '006050')->where('TW', 2)->exists() ? 'Ada' : 'Tidak Ada';
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
    public function showUploadForm()
    {
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        $tahun = session('tahun_terpilih');
        $mapping = $this->getMapping(); // method getMapping()
        $input = lke_buktidukung::all(); // contoh ambil semua dokumen
        return view('upload_file', compact('tahun', 'input', 'mapping'));
    }
public function upload(Request $request)
{
    $request->validate([
        'id_bukti' => 'required|integer',
        'file' => 'required|file|max:10240',
    ]);

    $id_bukti = $request->id_bukti;
    $file = $request->file('file');
    $tahun = session('tahun_terpilih') ?? date('Y');
    $id_satker = '006050';
    $namafile =
    $path = $file->store("uploads/bukti/$id_satker/$tahun");
    $mapping = $this->getMapping();

    $target = $mapping[$id_bukti] ?? null;
    if (!$target) {
        return back()->withErrors(['msg' => 'ID bukti tidak dikenali.']);
    }

    if (class_exists($target)) {

        $model = new $target();
        $model->id_satker = $id_satker;
        $model->id_periode = $tahun;
        $model->id_filename = $path;
        if (in_array($id_bukti, [10, 11])) {
            $tw = $id_bukti == 10 ? 'TW 1' : 'TW 2';
            $model->triwulan = $tw;
        } elseif (in_array($id_bukti, [37, 38])) {
            $tw = $id_bukti == 37 ? 1 : 2;
            $model->TW = $tw;
        } elseif (in_array($id_bukti, [39, 40])) {
            $tw = $id_bukti == 39 ? 1 : 2;
            $model->TW = $tw;
        }
        $model->id_tglupload = now();
        $model->save();
    } else {
        DB::table($target)->insert([
            'id_satker'   => $id_satker,
            'id_periode'  => $tahun,
            'id_filename' => $path,
            'id_tglupload'=> now(),
        ]);
    }

    return back()->with('success', 'Bukti dukung berhasil diupload.');
}

}
