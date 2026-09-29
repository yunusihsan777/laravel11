<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SasaranProgram;
use App\Models\IndikatorKinerjaProgram;
use App\Models\TargetIkp;
use App\Models\Pengukuran;
use Illuminate\Support\Facades\DB;

class PengukuranIkpController extends Controller
{
    /**
     * Memastikan hanya level 1 (Kejaksaan Agung) atau Administrator yang dapat mengakses.
     */
    protected function checkAccess()
    {
        $level = session('id_sakip_level');
        $satker = session('id_satker');
        $allowed = in_array($satker, ['admin', '999999']) || $level == '99' || $level == '1' || $level == 99 || $level == 1;
        if (!$allowed) {
            abort(403, 'Akses Ditolak: Menu Pengukuran IKP hanya dapat diakses oleh Administrator atau Kejaksaan Agung (Level 1).');
        }
    }

    /**
     * Halaman utama Pengukuran IKP
     */
    /**
     * Daftar seluruh satker bidang Kejagung beserta nama lengkap tanpa singkatan dan alias filter
     */
    public static function getFilteredBidangs()
    {
        $all = [
            [
                'id' => '691270',
                'nama' => 'Badan Pemulihan Aset',
                'alias' => ['pemulihan aset', 'bpa']
            ],
            [
                'id' => '419344',
                'nama' => 'Jaksa Agung Muda Bidang Tindak Pidana Khusus',
                'alias' => ['tindak pidana khusus', 'pidsus']
            ],
            [
                'id' => '418326',
                'nama' => 'Jaksa Agung Muda Bidang Tindak Pidana Umum',
                'alias' => ['tindak pidana umum', 'pidum']
            ],
            [
                'id' => '417023',
                'nama' => 'Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara',
                'alias' => ['perdata', 'tun', 'datun']
            ],
            [
                'id' => '677111',
                'nama' => 'Jaksa Agung Muda Bidang Pidana Militer',
                'alias' => ['pidana militer', 'pidmil']
            ],
            [
                'id' => '666405',
                'nama' => 'Badan Pendidikan dan Pelatihan',
                'alias' => ['pendidikan dan pelatihan', 'badiklat', 'diklat']
            ],
            [
                'id' => '419346',
                'nama' => 'Jaksa Agung Muda Bidang Pengawasan',
                'alias' => ['pengawasan', 'jamwas']
            ],
            [
                'id' => '419345',
                'nama' => 'Jaksa Agung Muda Bidang Intelijen',
                'alias' => ['intelijen', 'intel']
            ],
        ];

        $userSatker = (string) session('id_satker');
        $userName = strtolower(session('satkernama') ?? '');
        $userLevel = session('id_sakip_level');

        // Admin / Superuser dapat melihat semua bidang
        if (in_array($userSatker, ['admin', '999999', '888881']) || in_array($userLevel, [99, 0, '99', '0'])) {
            return $all;
        }

        // Cek apakah id_satker pengguna cocok dengan salah satu bidang
        $matched = array_values(array_filter($all, function ($item) use ($userSatker) {
            return $item['id'] === $userSatker;
        }));

        if (!empty($matched)) {
            return $matched;
        }

        // Cek apakah nama satker pengguna cocok dengan alias bidang
        $matchedByName = [];
        foreach ($all as $item) {
            foreach ($item['alias'] as $alias) {
                if (str_contains($userName, $alias)) {
                    $matchedByName[] = $item;
                    break;
                }
            }
        }

        if (!empty($matchedByName)) {
            return $matchedByName;
        }

        // Default jika tidak ada filter spesifik
        return $all;
    }

    /**
     * Halaman utama Pengukuran IKP
     */
    public function index(Request $request)
    {
        $this->checkAccess();

        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        $satkerBidangs = self::getFilteredBidangs();

        return view('kelola.pengukuran_ikp', compact('tahun', 'satkerBidangs'));
    }

    /**
     * Mendapatkan data SP, IKP, Target, dan Capaian per bidang via AJAX
     */
    public function getData($idSatkerBidang, Request $request)
    {
        $this->checkAccess();
        $tahun = session('tahun_terpilih');

        $sasaranPrograms = SasaranProgram::where('id_satker', $idSatkerBidang)
            ->where('tahun', $tahun)
            ->with(['indikatorKinerjaPrograms' => function ($q) use ($idSatkerBidang, $tahun) {
                $q->where('id_satker', $idSatkerBidang)->where('tahun', $tahun);
            }])
            ->get();

        $data = [];
        foreach ($sasaranPrograms as $sp) {
            $spItem = [
                'sp_id' => $sp->id,
                'kode_sp' => $sp->kode_sp,
                'nama_sp' => $sp->nama_sp,
                'ikps' => []
            ];

            foreach ($sp->indikatorKinerjaPrograms as $ikp) {
                $target = TargetIkp::where('ikp_id', $ikp->id)
                    ->where('id_satker', $idSatkerBidang)
                    ->where('tahun', $tahun)
                    ->first();

                $targetTahun = $target ? (float)$target->target_tahun : 0;
                $targetTw = [
                    1 => ($target && $target->target_tw1 !== null) ? (float)$target->target_tw1 : $targetTahun,
                    2 => ($target && $target->target_tw2 !== null) ? (float)$target->target_tw2 : $targetTahun,
                    3 => ($target && $target->target_tw3 !== null) ? (float)$target->target_tw3 : $targetTahun,
                    4 => ($target && $target->target_tw4 !== null) ? (float)$target->target_tw4 : $targetTahun,
                ];

                // Capaian dan perhitungan per triwulan (bulan 3, 6, 9, 12)
                $capaians = [];
                $perhitungans = [];
                for ($tw = 1; $tw <= 4; $tw++) {
                    $bulan = $tw * 3;
                    $pengukuran = Pengukuran::where('indikator_id', $ikp->id)
                        ->where('id_satker', $idSatkerBidang)
                        ->where('tahun', $tahun)
                        ->where('bulan', $bulan)
                        ->where('khusus', 2)
                        ->first();

                    $capaians[$tw] = $pengukuran ? $pengukuran->capaian : null;
                    $perhitungans[$tw] = $pengukuran ? $pengukuran->perhitungan : null;
                }

                $spItem['ikps'][] = [
                    'ikp_id' => $ikp->id,
                    'kode_ikp' => $ikp->kode_ikp,
                    'nama_ikp' => $ikp->nama_ikp,
                    'sifat_node' => $ikp->sifat_node,
                    'target_tahun' => $targetTahun,
                    'target_tw' => $targetTw,
                    'capaians' => $capaians,
                    'perhitungans' => $perhitungans,
                ];
            }

            $data[] = $spItem;
        }

        return response()->json($data);
    }

    /**
     * Menyimpan data capaian pengukuran IKP
     */
    public function store(Request $request)
    {
        $this->checkAccess();
        $tahun = session('tahun_terpilih');
        $idSatkerBidang = $request->input('id_satker_bidang');

        $capaianData = $request->input('capaian', []); // array [ikp_id][tw] => value

        foreach ($capaianData as $ikpId => $twValues) {
            $ikp = IndikatorKinerjaProgram::find($ikpId);
            if (!$ikp) {
                continue;
            }

            $targetRecord = TargetIkp::where('ikp_id', $ikpId)
                ->where('id_satker', $idSatkerBidang)
                ->where('tahun', $tahun)
                ->first();

            $targetTahun = $targetRecord ? (float)$targetRecord->target_tahun : 0;

            foreach ($twValues as $tw => $val) {
                $tw = (int)$tw;
                if ($tw < 1 || $tw > 4) {
                    continue;
                }
                $bulan = $tw * 3;

                if ($val !== null && $val !== '') {
                    $cleaned = str_replace(',', '.', str_replace('.', '', (string)$val));
                    $floatVal = is_numeric($val) ? (float)$val : (is_numeric($cleaned) ? (float)$cleaned : (float)$val);

                    $targetField = 'target_tw' . $tw;
                    $targetTwVal = ($targetRecord && $targetRecord->$targetField !== null)
                        ? (float)$targetRecord->$targetField
                        : $targetTahun;

                    $perhitungan = ($targetTwVal > 0) ? round(($floatVal / $targetTwVal) * 100, 2) : 0;

                    Pengukuran::updateOrCreate(
                        [
                            'indikator_id' => $ikpId,
                            'id_satker' => $idSatkerBidang,
                            'tahun' => $tahun,
                            'bulan' => $bulan,
                            'khusus' => 2,
                        ],
                        [
                            'capaian' => $floatVal,
                            'perhitungan' => $perhitungan,
                            'sub_indikator' => $ikp->kode_ikp,
                        ]
                    );
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pengukuran IKP berhasil disimpan!'
            ]);
        }

        return redirect()->back()->with('success', 'Data pengukuran IKP berhasil disimpan!');
    }
}
