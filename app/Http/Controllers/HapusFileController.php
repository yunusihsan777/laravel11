<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Renstra;
use App\Models\Renja;
use App\Models\Iku;
use App\Models\Rkakl;
use App\Models\Dipa;
use App\Models\Renaksi;
use App\Models\Pk;
use App\Models\Lkjip;
use App\Models\RapatStaffEka;
use App\Models\LheAkip;
use App\Models\TlLheAkip;
use App\Models\MonevRenaksi;
use App\Models\Kep;
use App\Models\TargetPK;
use App\Models\Pengukuran;

use App\Models\sample_skp;
use App\Models\sk_pm;
use App\Models\sk_pk;
use App\Models\absen_pm;
use App\Models\notulensi_pm;
use App\Models\nodis_p_sakip;
use App\Models\nodis_eval_sakip;
use App\Models\memo_datakinerja;
use App\Models\nodis_datakinerja;
use App\Models\reward_punish;
use App\Models\sampel_rekom;
use App\Models\ss_perencanaan;
use App\Models\ss_laporanweb;
use App\Models\ss_laporanapp;
use App\Models\tar_lkjip;
use App\Models\memo_lkjip;
use App\Models\tar_pm;
use App\Models\ba_praeval;
use App\Models\ba_pleno;
use App\Models\lhe_2023;

class HapusFileController extends Controller
{
    private const TAHUN_HAPUS = 2024;

    /**
     * Memastikan hanya Admin yang dapat mengakses fitur ini.
     */
    private function checkAdminAccess()
    {
        $level = session('id_sakip_level');
        $id_satker = session('id_satker');

        if ($level != 99 && !in_array($id_satker, [999999, 'admin', 'Pengawasan', 'Panev', 'menpanrb'])) {
            abort(403, 'Akses Ditolak. Fitur hapus file dan data tahunan ini hanya tersedia untuk pengguna Admin.');
        }
    }

    /**
     * Tampilkan form / preview hapus file & data berdasarkan tahun dan Kejati.
     */
    public function index(Request $request)
    {
        $this->checkAdminAccess();

        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahunSelected = self::TAHUN_HAPUS;
        $cakupan = $request->get('cakupan', 'semua'); // 'semua', 'kejati', 'satker'
        $idKejati = $request->get('id_kejati');
        $idSatkerTarget = $request->get('id_satker_target');

        // Ambil daftar Kejati dari sinori_login (Kejati ditandai dengan id_sakip_level == 2)
        $kejatiList = DB::table('sinori_login')
            ->select('id_kejati', DB::raw("MIN(REPLACE(satkernama, '_', ' ')) as kejati_nama"))
            ->where('id_sakip_level', 2)
            ->whereNotNull('id_kejati')
            ->where('id_kejati', '!=', '')
            ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
            ->where('id_satker', 'not like', 'was%')
            ->groupBy('id_kejati')
            ->orderBy('id_kejati', 'asc')
            ->get();

        $satkerFilterList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);
        $summary = $this->hitungDataTahun($tahunSelected, $satkerFilterList);

        return view('kelola.hapus_tahun', [
            'tahun' => $tahunSelected,
            'tahunSelected' => $tahunSelected,
            'cakupan' => $cakupan,
            'idKejati' => $idKejati,
            'idSatkerTarget' => $idSatkerTarget,
            'kejatiList' => $kejatiList,
            'summary' => $summary,
        ]);
    }

    /**
     * Preview AJAX ringkasan data.
     */
    public function previewData(Request $request)
    {
        $this->checkAdminAccess();

        $request->validate([
            'tahun_hapus' => 'required|integer|in:' . self::TAHUN_HAPUS,
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        $tahun = $request->tahun_hapus;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;

        $satkerFilterList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);
        $summary = $this->hitungDataTahun($tahun, $satkerFilterList);

        return response()->json([
            'success' => true,
            'tahun' => $tahun,
            'cakupan' => $cakupan,
            'total_satker' => count($satkerFilterList ?? []),
            'summary' => $summary,
        ]);
    }

    /**
     * API untuk mendapatkan daftar batch Satker untuk chunked background process.
     */
    public function getSatkerBatches(Request $request)
    {
        $this->checkAdminAccess();

        $request->validate([
            'tahun_hapus' => 'required|integer|in:' . self::TAHUN_HAPUS,
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        $tahun = $request->tahun_hapus;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;

        $satkerList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);

        // Jika null (semua satker tanpa filter spesifik array), ambil seluruh id_satker dari sinori_login
        if ($satkerList === null) {
            $satkerList = DB::table('sinori_login')
                ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
                ->pluck('id_satker')
                ->toArray();
        }

        // Pecah list satker menjadi batch (misal 5 satker per batch)
        $batches = array_chunk($satkerList, 5);

        return response()->json([
            'success' => true,
            'tahun' => $tahun,
            'total_satkers' => count($satkerList),
            'total_batches' => count($batches),
            'batches' => $batches,
        ]);
    }

    /**
     * API pemrosesan 1 batch Satker (menghindari timeout 30s).
     */
    public function processBatch(Request $request)
    {
        $this->checkAdminAccess();

        @set_time_limit(0);
        @ini_set('max_execution_time', '0');
        @ini_set('memory_limit', '1024M');

        $request->validate([
            'tahun_hapus' => 'required|integer|in:' . self::TAHUN_HAPUS,
            'satker_ids' => 'required|array',
        ]);

        $tahun = $request->tahun_hapus;
        $satkerIds = $request->satker_ids;

        $res = $this->executeDeletionForSatkers($tahun, $satkerIds);

        return response()->json([
            'success' => true,
            'satker_count' => count($satkerIds),
            'files_deleted' => $res['deletedFilesCount'],
            'records_deleted' => $res['deletedRecordsCount'],
        ]);
    }

    /**
     * Eksekusi Synchronous (Direct submit fallback dengan extended timeout).
     */
    public function destroyByTahun(Request $request)
    {
        $this->checkAdminAccess();

        // Menaikkan batas waktu eksekusi agar tidak terkena 30s limit
        @set_time_limit(0);
        @ini_set('max_execution_time', '0');
        @ini_set('memory_limit', '1024M');
        ignore_user_abort(true);

        $request->validate([
            'tahun_hapus' => 'required|integer|in:' . self::TAHUN_HAPUS,
            'cakupan' => 'required|in:semua,kejati,satker',
            'konfirmasi' => 'required|string',
        ]);

        if (strtoupper(trim($request->konfirmasi)) !== 'HAPUS') {
            return redirect()->back()->with('error', 'Teks konfirmasi tidak sesuai. Penghapusan dibatalkan.');
        }

        $tahun = $request->tahun_hapus;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;

        $satkerList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);

        $res = $this->executeDeletionForSatkers($tahun, $satkerList);

        $msgCakupan = ($cakupan === 'kejati') ? "Kejati [{$idKejati}]" : (($cakupan === 'satker') ? "Satker [{$idSatkerTarget}]" : "Seluruh Satker");

        return redirect()->back()->with('success', "Berhasil menghapus seluruh file dan data tahun {$tahun} untuk {$msgCakupan}. Total file terhapus: {$res['deletedFilesCount']}, total data terhapus: {$res['deletedRecordsCount']}.");
    }

    /**
     * Core logic penghapusan fisik file & database record untuk list satker.
     */
    private function executeDeletionForSatkers($tahun, $satkerList = null)
    {
        $deletedFilesCount = 0;
        $deletedRecordsCount = 0;

        $documentModels = [
            ['model' => Renstra::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename', 'is_renstra' => true],
            ['model' => Renja::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Iku::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Rkakl::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Dipa::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Renaksi::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Pk::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Lkjip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => RapatStaffEka::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => LheAkip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => TlLheAkip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => MonevRenaksi::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => Kep::class, 'periode_col' => 'id_tahun', 'file_col' => 'id_filesurat', 'is_kep' => true],
            ['model' => sample_skp::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => sk_pm::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => sk_pk::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => absen_pm::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => notulensi_pm::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => nodis_p_sakip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => nodis_eval_sakip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => memo_datakinerja::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => nodis_datakinerja::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => reward_punish::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => sampel_rekom::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => ss_perencanaan::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => ss_laporanweb::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => ss_laporanapp::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => tar_lkjip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => memo_lkjip::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => tar_pm::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => ba_praeval::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => ba_pleno::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
            ['model' => lhe_2023::class, 'periode_col' => 'id_periode', 'file_col' => 'id_filename'],
        ];

        foreach ($documentModels as $item) {
            $query = ($item['model'])::query();

            if (!empty($item['is_renstra'])) {
                $idPeriode = ($tahun == "2024") ? "P1" : (($tahun >= "2025" && $tahun <= "2029") ? "P2" : $tahun);
                $query->where(function($q) use ($tahun, $idPeriode) {
                    $q->where('id_periode', $tahun)->orWhere('id_periode', $idPeriode);
                });
            } else {
                $query->where($item['periode_col'], $tahun);
            }

            if ($satkerList !== null) {
                $query->whereIn('id_satker', $satkerList);
            }

            $records = $query->get();

            foreach ($records as $record) {
                $fileName = $record->{$item['file_col']} ?? null;
                $satker = $record->id_satker ?? null;

                if ($fileName) {
                    if (!empty($item['is_kep'])) {
                        $this->deletePhysicalFile("public/uploads/KEP/{$fileName}");
                        $this->deletePhysicalFile("uploads/KEP/{$fileName}");
                    } else {
                        if ($satker) {
                            $this->deletePhysicalFile("public/uploads/repository/{$satker}/{$fileName}");
                            $this->deletePhysicalFile("uploads/repository/{$satker}/{$fileName}");
                        }
                    }
                    $deletedFilesCount++;
                }

                $record->delete();
                $deletedRecordsCount++;
            }
        }

        // Hapus data Pengukuran & TargetPK
        $dataModels = [
            ['model' => TargetPK::class, 'col' => 'tahun'],
            ['model' => Pengukuran::class, 'col' => 'tahun'],
        ];

        foreach ($dataModels as $dm) {
            $q = ($dm['model'])::where($dm['col'], $tahun);
            if ($satkerList !== null) {
                $q->whereIn('id_satker', $satkerList);
            }
            $deletedRecordsCount += $q->delete();
        }

        // Scan orphan files pada folder satker
        $deletedOrphanCount = $this->scanAndDeleteOrphanFiles($tahun, $satkerList);
        $deletedFilesCount += $deletedOrphanCount;

        return [
            'deletedFilesCount' => $deletedFilesCount,
            'deletedRecordsCount' => $deletedRecordsCount,
        ];
    }

    /**
     * Resolusi cakupan menjadi array ID Satker.
     */
    private function resolveSatkerList($cakupan, $idKejati = null, $idSatkerTarget = null)
    {
        if ($cakupan === 'satker' && $idSatkerTarget) {
            return [(string)$idSatkerTarget];
        }

        if ($cakupan === 'kejati' && $idKejati) {
            return DB::table('sinori_login')
                ->where('id_kejati', $idKejati)
                ->pluck('id_satker')
                ->map(fn($v) => (string)$v)
                ->toArray();
        }

        return null; // Seluruh Satker
    }

    /**
     * Hitung ringkasan data & file berdasarkan tahun & list satker.
     */
    private function hitungDataTahun($tahun, $satkerList = null)
    {
        $totalRecords = 0;
        $totalFiles = 0;

        $models = [
            Renstra::class => ['col' => 'id_periode', 'file' => 'id_filename', 'is_renstra' => true],
            Renja::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Iku::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Rkakl::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Dipa::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Renaksi::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Pk::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Lkjip::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            RapatStaffEka::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            LheAkip::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            TlLheAkip::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            MonevRenaksi::class => ['col' => 'id_periode', 'file' => 'id_filename'],
            Kep::class => ['col' => 'id_tahun', 'file' => 'id_filesurat'],
            TargetPK::class => ['col' => 'tahun', 'file' => null],
            Pengukuran::class => ['col' => 'tahun', 'file' => null],
        ];

        foreach ($models as $modelClass => $cfg) {
            $q = $modelClass::query();

            if (!empty($cfg['is_renstra'])) {
                $idPeriode = ($tahun == "2024") ? "P1" : (($tahun >= "2025" && $tahun <= "2029") ? "P2" : $tahun);
                $q->where(function($sub) use ($tahun, $idPeriode) {
                    $sub->where('id_periode', $tahun)->orWhere('id_periode', $idPeriode);
                });
            } else {
                $q->where($cfg['col'], $tahun);
            }

            if ($satkerList !== null) {
                $q->whereIn('id_satker', $satkerList);
            }

            $count = $q->count();
            $totalRecords += $count;

            if (!empty($cfg['file'])) {
                $totalFiles += $count;
            }
        }

        return [
            'total_records' => $totalRecords,
            'total_files' => $totalFiles,
        ];
    }

    private function deletePhysicalFile($relativePath)
    {
        $fullPath = base_path($relativePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return true;
        }

        $publicPath = public_path(str_replace('public/', '', $relativePath));
        if (File::exists($publicPath)) {
            File::delete($publicPath);
            return true;
        }

        return false;
    }

    private function scanAndDeleteOrphanFiles($tahun, $satkerList = null)
    {
        $deleted = 0;
        $baseDirs = [
            public_path('uploads/repository'),
            base_path('uploads/repository')
        ];

        foreach ($baseDirs as $repoDir) {
            if (!File::exists($repoDir)) continue;

            $satkerDirs = File::directories($repoDir);
            foreach ($satkerDirs as $satkerDir) {
                $folderSatkerName = (string)basename($satkerDir);

                if ($satkerList !== null && !in_array($folderSatkerName, $satkerList)) {
                    continue;
                }

                $files = File::files($satkerDir);
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    if (preg_match('/_' . preg_quote($tahun, '/') . '(_|\.|\s)/i', $filename)) {
                        File::delete($file->getPathname());
                        $deleted++;
                    }
                }
            }
        }

        return $deleted;
    }
}
