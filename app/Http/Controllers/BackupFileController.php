<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

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

class BackupFileController extends Controller
{
    /**
     * Memastikan hanya Admin yang dapat mengakses fitur ini.
     */
    private function checkAdminAccess()
    {
        $level = session('id_sakip_level');
        $id_satker = session('id_satker');

        if ($level != 99 && !in_array($id_satker, [999999, 'admin', 'Pengawasan', 'Panev', 'menpanrb'])) {
            abort(403, 'Akses Ditolak. Fitur backup file tahunan ini hanya tersedia untuk pengguna Admin.');
        }
    }

    /**
     * Tampilkan halaman utama / dashboard Backup File.
     */
    public function index(Request $request)
    {
        $this->checkAdminAccess();

        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahunSelected = $request->get('tahun_backup', session('tahun_terpilih', date('Y')));
        $cakupan = $request->get('cakupan', 'kejati');
        $idKejati = $request->get('id_kejati');
        $idSatkerTarget = $request->get('id_satker_target');
        $targetPath = $request->get('target_path', 'E:\\backup');

        // Ambil daftar Kejati (id_sakip_level == 2) dari sinori_login
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

        // Jika belum ada Kejati terpilih dan cakupan kejati, defaultkan ke Kejati pertama jika ada
        if (!$idKejati && $cakupan === 'kejati' && $kejatiList->isNotEmpty()) {
            $idKejati = $kejatiList->first()->id_kejati;
        }

        $satkerFilterList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);
        $summary = $this->analyzeBackupFiles($tahunSelected, $satkerFilterList, $targetPath);

        return view('kelola.backup_tahun', [
            'tahun' => $tahunSelected,
            'tahunSelected' => $tahunSelected,
            'cakupan' => $cakupan,
            'idKejati' => $idKejati,
            'idSatkerTarget' => $idSatkerTarget,
            'targetPath' => $targetPath,
            'kejatiList' => $kejatiList,
            'summary' => $summary,
        ]);
    }

    /**
     * Preview AJAX ringkasan file yang siap dibackup.
     */
    public function previewData(Request $request)
    {
        $this->checkAdminAccess();

        $request->validate([
            'tahun_backup' => 'required',
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        $tahun = $request->tahun_backup;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;
        $targetPath = $request->get('target_path', 'E:\\backup');

        $satkerFilterList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);
        $summary = $this->analyzeBackupFiles($tahun, $satkerFilterList, $targetPath);

        return response()->json([
            'success' => true,
            'tahun' => $tahun,
            'cakupan' => $cakupan,
            'target_path' => $targetPath,
            'summary' => $summary,
        ]);
    }

    /**
     * API untuk memecah daftar Satker ke dalam batch (5 satker per batch) untuk eksekusi background.
     */
    public function getBackupBatches(Request $request)
    {
        $this->checkAdminAccess();

        $request->validate([
            'tahun_backup' => 'required',
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        $tahun = $request->tahun_backup;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;
        $targetPath = rtrim($request->get('target_path', 'E:\\backup'), '\\/');

        $satkerList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);

        if ($satkerList === null) {
            $satkerList = DB::table('sinori_login')
                ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
                ->pluck('id_satker')
                ->map(fn($v) => (string)$v)
                ->toArray();
        }

        // Pecah list satker menjadi batch (5 satker per batch)
        $batches = array_chunk($satkerList, 5);

        return response()->json([
            'success' => true,
            'tahun' => $tahun,
            'target_path' => $targetPath,
            'total_satkers' => count($satkerList),
            'total_batches' => count($batches),
            'batches' => $batches,
        ]);
    }

    /**
     * API Pemrosesan Backup 1 Batch Satker ke folder lokal (misal: E:\backup\{id_satker}\).
     */
    public function processBackupBatch(Request $request)
    {
        $this->checkAdminAccess();

        @set_time_limit(0);
        @ini_set('max_execution_time', '0');
        @ini_set('memory_limit', '1024M');

        $request->validate([
            'tahun_backup' => 'required',
            'satker_ids' => 'required|array',
        ]);

        $tahun = $request->tahun_backup;
        $satkerIds = $request->satker_ids;
        $targetPath = rtrim($request->get('target_path', 'E:\\backup'), '\\/');

        // Pastikan target path ada / dapat dibuat
        if (!File::exists($targetPath)) {
            try {
                File::makeDirectory($targetPath, 0777, true, true);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => "Gagal membuat folder tujuan backup [{$targetPath}]: " . $e->getMessage(),
                ], 500);
            }
        }

        $expectedDbMap = $this->getExpectedDbFileMap($tahun, $satkerIds);
        $copiedFilesCount = 0;
        $copiedBytes = 0;

        foreach ($satkerIds as $satker) {
            $destSatkerDir = $targetPath . DIRECTORY_SEPARATOR . $satker;
            if (!File::exists($destSatkerDir)) {
                File::makeDirectory($destSatkerDir, 0777, true, true);
            }

            // 1. Kumpulkan file yang tercatat di database untuk satker ini
            $satkerDbFiles = [];
            foreach ($expectedDbMap as $filename => $info) {
                if ($info['satker'] === (string)$satker) {
                    $satkerDbFiles[$filename] = $info;
                }
            }

            // 2. Cari file fisik yang ada di server (public/uploads/repository/{satker} atau base uploads/repository/{satker})
            $sourceDirs = [
                public_path('uploads/repository/' . $satker),
                base_path('uploads/repository/' . $satker),
            ];

            $processedFiles = [];

            foreach ($sourceDirs as $srcDir) {
                if (!File::exists($srcDir)) {
                    continue;
                }

                $files = File::files($srcDir);
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    if (isset($processedFiles[$filename])) {
                        continue;
                    }

                    $include = false;

                    // Cek apakah file tercatat di DB
                    if (isset($satkerDbFiles[$filename])) {
                        $include = true;
                    } elseif ($tahun === 'semua') {
                        // Jika backup semua tahun, salin semua PDF di folder satker
                        $include = true;
                    } else {
                        // Cek apakah nama file mengandung pola tahun yang dipilih
                        if (preg_match('/_' . preg_quote($tahun, '/') . '(_|\.|\s)/i', $filename) ||
                            str_contains($filename, (string)$tahun)) {
                            $include = true;
                        }
                    }

                    if ($include) {
                        $destFilePath = $destSatkerDir . DIRECTORY_SEPARATOR . $filename;
                        
                        // Salin file jika belum ada di target atau jika ukuran berbeda
                        if (!File::exists($destFilePath) || File::size($file->getPathname()) !== File::size($destFilePath)) {
                            File::copy($file->getPathname(), $destFilePath);
                            $copiedFilesCount++;
                            $copiedBytes += $file->getSize();
                        }
                        $processedFiles[$filename] = true;
                    }
                }
            }

            // 3. Khusus file KEP yang terdaftar untuk satker ini (jika ada)
            foreach ($satkerDbFiles as $filename => $info) {
                if (!empty($info['is_kep']) && !isset($processedFiles[$filename])) {
                    $kepSources = [
                        public_path('uploads/KEP/' . $filename),
                        base_path('uploads/KEP/' . $filename),
                    ];
                    foreach ($kepSources as $src) {
                        if (File::exists($src)) {
                            $destKepDir = $targetPath . DIRECTORY_SEPARATOR . 'KEP';
                            if (!File::exists($destKepDir)) {
                                File::makeDirectory($destKepDir, 0777, true, true);
                            }
                            $destFile = $destKepDir . DIRECTORY_SEPARATOR . $filename;
                            if (!File::exists($destFile)) {
                                File::copy($src, $destFile);
                                $copiedFilesCount++;
                                $copiedBytes += File::size($src);
                            }
                            // Juga salin ke folder satker untuk kemudahan pencarian
                            $destSatkerFile = $destSatkerDir . DIRECTORY_SEPARATOR . $filename;
                            if (!File::exists($destSatkerFile)) {
                                File::copy($src, $destSatkerFile);
                            }
                            $processedFiles[$filename] = true;
                            break;
                        }
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'satker_count' => count($satkerIds),
            'files_copied' => $copiedFilesCount,
            'bytes_copied' => $copiedBytes,
            'formatted_bytes' => $this->formatBytes($copiedBytes),
        ]);
    }

    /**
     * Inisialisasi proses batching ZIP file anti-timeout.
     */
    public function initZipBatch(Request $request)
    {
        $this->checkAdminAccess();

        $request->validate([
            'tahun_backup' => 'required',
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        if (!class_exists('ZipArchive')) {
            return response()->json([
                'success' => false,
                'message' => 'Ekstensi PHP ZipArchive tidak aktif pada server.',
            ], 500);
        }

        $this->cleanOldTempZipFiles();

        $tahun = $request->tahun_backup;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;

        $satkerList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);

        if ($satkerList === null) {
            $satkerList = DB::table('sinori_login')
                ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
                ->pluck('id_satker')
                ->map(fn($v) => (string)$v)
                ->toArray();
        }

        $label = ($cakupan === 'kejati' && $idKejati) ? "kejati_{$idKejati}" : (($cakupan === 'satker') ? "satker_{$idSatkerTarget}" : "all_satker");
        $zipFileName = "backup_{$label}_tahun_{$tahun}_" . date('Ymd_His') . ".zip";
        $zipToken = md5(uniqid(mt_rand(), true));

        $tempDir = storage_path('app/backup_temp');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0777, true, true);
        }

        $tempZipPath = $tempDir . DIRECTORY_SEPARATOR . $zipToken . '.zip';
        $metaPath = $tempDir . DIRECTORY_SEPARATOR . $zipToken . '.json';

        $zip = new ZipArchive();
        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat file arsip ZIP di server.',
            ], 500);
        }
        $zip->addFromString('backup_info.txt', "Backup Arsip Dokumen E-SAKIP\nCakupan: {$label}\nTahun: {$tahun}\nDibuat pada: " . date('Y-m-d H:i:s'));
        $zip->close();

        File::put($metaPath, json_encode([
            'token' => $zipToken,
            'filename' => $zipFileName,
            'tahun' => $tahun,
            'cakupan' => $label,
            'created_at' => time(),
            'total_files' => 0,
            'total_bytes' => 0,
        ]));

        // Batch 4 satker per request untuk kompresi agar cepat dan terhindar dari timeout Nginx
        $batches = array_chunk($satkerList, 4);

        return response()->json([
            'success' => true,
            'zip_token' => $zipToken,
            'zip_filename' => $zipFileName,
            'total_satkers' => count($satkerList),
            'total_batches' => count($batches),
            'batches' => $batches,
        ]);
    }

    /**
     * Menambahkan batch satker ke dalam file ZIP yang sedang dibangun di server.
     */
    public function addBatchToZip(Request $request)
    {
        $this->checkAdminAccess();

        @set_time_limit(180);
        @ini_set('max_execution_time', '180');
        @ini_set('memory_limit', '1024M');

        $request->validate([
            'zip_token' => 'required|string',
            'tahun_backup' => 'required',
            'satker_ids' => 'required|array',
        ]);

        $zipToken = preg_replace('/[^a-f0-9]/', '', $request->zip_token);
        $tempDir = storage_path('app/backup_temp');
        $tempZipPath = $tempDir . DIRECTORY_SEPARATOR . $zipToken . '.zip';
        $metaPath = $tempDir . DIRECTORY_SEPARATOR . $zipToken . '.json';

        if (!File::exists($tempZipPath)) {
            return response()->json([
                'success' => false,
                'message' => 'File arsip ZIP tidak ditemukan atau sudah kedaluwarsa.',
            ], 404);
        }

        $tahun = $request->tahun_backup;
        $satkerIds = $request->satker_ids;

        $zip = new ZipArchive();
        if ($zip->open($tempZipPath) !== true) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuka arsip ZIP untuk penambahan file.',
            ], 500);
        }

        $expectedDbMap = $this->getExpectedDbFileMap($tahun, $satkerIds);
        $filesAddedInBatch = 0;
        $bytesAddedInBatch = 0;

        foreach ($satkerIds as $satker) {
            $satkerDbFiles = [];
            foreach ($expectedDbMap as $filename => $info) {
                if ($info['satker'] === (string)$satker) {
                    $satkerDbFiles[$filename] = $info;
                }
            }

            $sourceDirs = [
                public_path('uploads/repository/' . $satker),
                base_path('uploads/repository/' . $satker),
            ];

            $processedInSatker = [];

            foreach ($sourceDirs as $srcDir) {
                if (!File::exists($srcDir)) {
                    continue;
                }

                $files = File::files($srcDir);
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    if (isset($processedInSatker[$filename])) {
                        continue;
                    }

                    $include = false;

                    if (isset($satkerDbFiles[$filename])) {
                        $include = true;
                    } elseif ($tahun === 'semua') {
                        $include = true;
                    } else {
                        if (preg_match('/_' . preg_quote($tahun, '/') . '(_|\.|\s)/i', $filename) ||
                            str_contains($filename, (string)$tahun)) {
                            $include = true;
                        }
                    }

                    if ($include) {
                        $zip->addFile($file->getPathname(), "{$satker}/{$filename}");
                        $processedInSatker[$filename] = true;
                        $filesAddedInBatch++;
                        $bytesAddedInBatch += $file->getSize();
                    }
                }
            }

            // File KEP
            foreach ($satkerDbFiles as $filename => $info) {
                if (!empty($info['is_kep']) && !isset($processedInSatker[$filename])) {
                    $kepSources = [
                        public_path('uploads/KEP/' . $filename),
                        base_path('uploads/KEP/' . $filename),
                    ];
                    foreach ($kepSources as $src) {
                        if (File::exists($src)) {
                            $zip->addFile($src, "KEP/{$filename}");
                            $processedInSatker[$filename] = true;
                            $filesAddedInBatch++;
                            $bytesAddedInBatch += File::size($src);
                            break;
                        }
                    }
                }
            }
        }

        $zip->close();

        // Update metadata
        if (File::exists($metaPath)) {
            $meta = json_decode(File::get($metaPath), true) ?: [];
            $meta['total_files'] = ($meta['total_files'] ?? 0) + $filesAddedInBatch;
            $meta['total_bytes'] = ($meta['total_bytes'] ?? 0) + $bytesAddedInBatch;
            File::put($metaPath, json_encode($meta));
        }

        return response()->json([
            'success' => true,
            'files_added' => $filesAddedInBatch,
            'bytes_added' => $bytesAddedInBatch,
            'formatted_bytes' => $this->formatBytes($bytesAddedInBatch),
        ]);
    }

    /**
     * Download file ZIP yang sudah selesai dirangkai di background batch.
     */
    public function downloadZipReady(Request $request)
    {
        $this->checkAdminAccess();

        $token = preg_replace('/[^a-f0-9]/', '', (string)$request->query('token'));
        if (empty($token)) {
            return redirect()->route('backuptahun.index')->with('error', 'Token download backup tidak valid.');
        }

        $tempDir = storage_path('app/backup_temp');
        $zipPath = $tempDir . DIRECTORY_SEPARATOR . $token . '.zip';
        $metaPath = $tempDir . DIRECTORY_SEPARATOR . $token . '.json';

        if (!File::exists($zipPath)) {
            return redirect()->route('backuptahun.index')->with('error', 'File ZIP backup tidak ditemukan atau sudah kedaluwarsa. Silakan lakukan proses backup ulang.');
        }

        $fileName = "backup_dokumen_" . date('Ymd_His') . ".zip";
        if (File::exists($metaPath)) {
            $meta = json_decode(File::get($metaPath), true);
            if (!empty($meta['filename'])) {
                $fileName = $meta['filename'];
            }
            @File::delete($metaPath);
        }

        return response()->download($zipPath, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Download seluruh file backup sebagai ZIP Archive per Kejati / Satker (Direct / Fallback).
     */
    public function downloadZip(Request $request)
    {
        $this->checkAdminAccess();

        @set_time_limit(0);
        @ini_set('max_execution_time', '0');
        @ini_set('memory_limit', '2048M');

        $request->validate([
            'tahun_backup' => 'required',
            'cakupan' => 'required|in:semua,kejati,satker',
        ]);

        if (!class_exists('ZipArchive')) {
            return redirect()->back()->with('error', 'Ekstensi PHP ZipArchive tidak aktif pada server.');
        }

        $tahun = $request->tahun_backup;
        $cakupan = $request->cakupan;
        $idKejati = $request->id_kejati;
        $idSatkerTarget = $request->id_satker_target;

        $satkerList = $this->resolveSatkerList($cakupan, $idKejati, $idSatkerTarget);

        if ($satkerList === null) {
            $satkerList = DB::table('sinori_login')
                ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
                ->pluck('id_satker')
                ->map(fn($v) => (string)$v)
                ->toArray();
        }

        $expectedDbMap = $this->getExpectedDbFileMap($tahun, $satkerList);

        // Buat temporary ZIP file
        $label = ($cakupan === 'kejati' && $idKejati) ? "kejati_{$idKejati}" : (($cakupan === 'satker') ? "satker_{$idSatkerTarget}" : "all_satker");
        $zipFileName = "backup_{$label}_tahun_{$tahun}_" . date('Ymd_His') . ".zip";
        $tempZipPath = storage_path('app/backup_temp_' . uniqid() . '.zip');

        $zip = new ZipArchive();
        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return redirect()->back()->with('error', 'Gagal membuat file arsip ZIP di server.');
        }

        $filesAdded = 0;

        foreach ($satkerList as $satker) {
            // Filter DB file map for this satker
            $satkerDbFiles = [];
            foreach ($expectedDbMap as $filename => $info) {
                if ($info['satker'] === (string)$satker) {
                    $satkerDbFiles[$filename] = $info;
                }
            }

            $sourceDirs = [
                public_path('uploads/repository/' . $satker),
                base_path('uploads/repository/' . $satker),
            ];

            $processedInSatker = [];

            foreach ($sourceDirs as $srcDir) {
                if (!File::exists($srcDir)) {
                    continue;
                }

                $files = File::files($srcDir);
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    if (isset($processedInSatker[$filename])) {
                        continue;
                    }

                    $include = false;

                    if (isset($satkerDbFiles[$filename])) {
                        $include = true;
                    } elseif ($tahun === 'semua') {
                        $include = true;
                    } else {
                        if (preg_match('/_' . preg_quote($tahun, '/') . '(_|\.|\s)/i', $filename) ||
                            str_contains($filename, (string)$tahun)) {
                            $include = true;
                        }
                    }

                    if ($include) {
                        // Masukkan ke ZIP dengan subfolder: {satker}/{filename}
                        $zip->addFile($file->getPathname(), "{$satker}/{$filename}");
                        $processedInSatker[$filename] = true;
                        $filesAdded++;
                    }
                }
            }

            // KEP files
            foreach ($satkerDbFiles as $filename => $info) {
                if (!empty($info['is_kep']) && !isset($processedInSatker[$filename])) {
                    $kepSources = [
                        public_path('uploads/KEP/' . $filename),
                        base_path('uploads/KEP/' . $filename),
                    ];
                    foreach ($kepSources as $src) {
                        if (File::exists($src)) {
                            $zip->addFile($src, "KEP/{$filename}");
                            $processedInSatker[$filename] = true;
                            $filesAdded++;
                            break;
                        }
                    }
                }
            }
        }

        $zip->close();

        if ($filesAdded === 0) {
            if (File::exists($tempZipPath)) {
                File::delete($tempZipPath);
            }
            return redirect()->back()->with('error', "Tidak ditemukan file fisik yang dapat di-backup untuk filter tahun {$tahun} dan cakupan terpilih.");
        }

        return response()->download($tempZipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Menganalisis file yang tersedia untuk di-backup.
     */
    private function analyzeBackupFiles($tahun, $satkerList = null, $targetPath = 'E:\\backup')
    {
        $map = $this->getExpectedDbFileMap($tahun, $satkerList);
        $targetPathClean = rtrim($targetPath, '\\/');
        $targetExists = File::exists($targetPathClean);

        $totalExpected = 0;
        $foundServerCount = 0;
        $totalBytes = 0;
        $alreadyInBackupCount = 0;
        $fileList = [];

        // Kumpulkan daftar satker yang valid
        $activeSatkers = $satkerList;
        if ($activeSatkers === null) {
            $activeSatkers = DB::table('sinori_login')
                ->whereNotIn('id_satker', [888881, 888882, 'admin', 999999, 'Pengawasan', 'Panev', 'menpanrb'])
                ->pluck('id_satker')
                ->map(fn($v) => (string)$v)
                ->toArray();
        }

        // Scan DB records
        foreach ($map as $filename => $info) {
            if ($satkerList !== null && !in_array($info['satker'], $satkerList)) {
                continue;
            }

            $totalExpected++;
            $satker = $info['satker'];
            $fileServerPath = null;

            if ($info['is_kep']) {
                if (File::exists(public_path("uploads/KEP/{$filename}"))) {
                    $fileServerPath = public_path("uploads/KEP/{$filename}");
                } elseif (File::exists(base_path("uploads/KEP/{$filename}"))) {
                    $fileServerPath = base_path("uploads/KEP/{$filename}");
                }
            } else {
                if (File::exists(public_path("uploads/repository/{$satker}/{$filename}"))) {
                    $fileServerPath = public_path("uploads/repository/{$satker}/{$filename}");
                } elseif (File::exists(base_path("uploads/repository/{$satker}/{$filename}"))) {
                    $fileServerPath = base_path("uploads/repository/{$satker}/{$filename}");
                }
            }

            $foundInTarget = false;
            if ($targetExists) {
                $targetFile = $targetPathClean . DIRECTORY_SEPARATOR . $satker . DIRECTORY_SEPARATOR . $filename;
                $targetKepFile = $targetPathClean . DIRECTORY_SEPARATOR . 'KEP' . DIRECTORY_SEPARATOR . $filename;
                if (File::exists($targetFile) || File::exists($targetKepFile)) {
                    $foundInTarget = true;
                    $alreadyInBackupCount++;
                }
            }

            if ($fileServerPath) {
                $foundServerCount++;
                $fSize = File::size($fileServerPath);
                $totalBytes += $fSize;

                $fileList[] = [
                    'filename' => $filename,
                    'satker' => $satker,
                    'size' => $this->formatBytes($fSize),
                    'in_server' => true,
                    'in_target' => $foundInTarget,
                ];
            } else {
                $fileList[] = [
                    'filename' => $filename,
                    'satker' => $satker,
                    'size' => '-',
                    'in_server' => false,
                    'in_target' => $foundInTarget,
                ];
            }
        }

        // Tambahkan juga scan file fisik langsung di folder satker (untuk file yang mungkin belum tercatat di DB map)
        foreach ($activeSatkers as $satker) {
            $dirs = [
                public_path('uploads/repository/' . $satker),
                base_path('uploads/repository/' . $satker),
            ];
            foreach ($dirs as $dir) {
                if (!File::exists($dir)) {
                    continue;
                }
                $physFiles = File::files($dir);
                foreach ($physFiles as $pf) {
                    $pFilename = $pf->getFilename();
                    // Lewati jika sudah ada di map
                    if (isset($map[$pFilename])) {
                        continue;
                    }

                    $include = false;
                    if ($tahun === 'semua') {
                        $include = true;
                    } elseif (preg_match('/_' . preg_quote($tahun, '/') . '(_|\.|\s)/i', $pFilename) || str_contains($pFilename, (string)$tahun)) {
                        $include = true;
                    }

                    if ($include) {
                        $fSize = $pf->getSize();
                        $totalBytes += $fSize;
                        $foundServerCount++;

                        $foundInTarget = false;
                        if ($targetExists && File::exists($targetPathClean . DIRECTORY_SEPARATOR . $satker . DIRECTORY_SEPARATOR . $pFilename)) {
                            $foundInTarget = true;
                            $alreadyInBackupCount++;
                        }

                        $fileList[] = [
                            'filename' => $pFilename,
                            'satker' => $satker,
                            'size' => $this->formatBytes($fSize),
                            'in_server' => true,
                            'in_target' => $foundInTarget,
                        ];
                    }
                }
            }
        }

        return [
            'total_satkers' => count($activeSatkers),
            'total_expected_db' => $totalExpected,
            'found_server_count' => $foundServerCount,
            'already_in_backup_count' => $alreadyInBackupCount,
            'total_bytes' => $totalBytes,
            'formatted_size' => $this->formatBytes($totalBytes),
            'target_exists' => $targetExists,
            'target_path' => $targetPathClean,
            'sample_files' => array_slice($fileList, 0, 1000),
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

        return null;
    }

    /**
     * Ambil pemetaan seluruh file yang dicatat di database untuk tahun dan daftar satker terpilih.
     */
    private function getExpectedDbFileMap($tahun, $satkerList = null)
    {
        $map = [];

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
            try {
                $query = ($item['model'])::query();

                if ($tahun !== 'semua') {
                    if (!empty($item['is_renstra'])) {
                        $idPeriode = ($tahun == "2024") ? "P1" : (($tahun >= "2025" && $tahun <= "2029") ? "P2" : $tahun);
                        $query->where(function($q) use ($tahun, $idPeriode) {
                            $q->where('id_periode', $tahun)->orWhere('id_periode', $idPeriode);
                        });
                    } else {
                        $query->where($item['periode_col'], $tahun);
                    }
                }

                if ($satkerList !== null && is_array($satkerList) && count($satkerList) > 0) {
                    $query->whereIn('id_satker', $satkerList);
                }

                $records = $query->select(['id_satker', $item['file_col']])->get();

                foreach ($records as $rec) {
                    $filename = $rec->{$item['file_col']} ?? null;
                    $satker = $rec->id_satker ?? null;

                    if ($filename) {
                        $map[$filename] = [
                            'satker' => (string)$satker,
                            'is_kep' => !empty($item['is_kep']),
                        ];
                    }
                }
            } catch (\Throwable $e) {
                // Fallback jika query khusus kolom gagal
                try {
                    $queryFallback = ($item['model'])::query();
                    if ($tahun !== 'semua') {
                        if (!empty($item['is_renstra'])) {
                            $idPeriode = ($tahun == "2024") ? "P1" : (($tahun >= "2025" && $tahun <= "2029") ? "P2" : $tahun);
                            $queryFallback->where(function($q) use ($tahun, $idPeriode) {
                                $q->where('id_periode', $tahun)->orWhere('id_periode', $idPeriode);
                            });
                        } else {
                            $queryFallback->where($item['periode_col'], $tahun);
                        }
                    }
                    if ($satkerList !== null && is_array($satkerList) && count($satkerList) > 0) {
                        $queryFallback->whereIn('id_satker', $satkerList);
                    }
                    $records = $queryFallback->get();
                    foreach ($records as $rec) {
                        $filename = $rec->{$item['file_col']} ?? null;
                        $satker = $rec->id_satker ?? null;
                        if ($filename) {
                            $map[$filename] = [
                                'satker' => (string)$satker,
                                'is_kep' => !empty($item['is_kep']),
                            ];
                        }
                    }
                } catch (\Throwable $e2) {
                    continue;
                }
            }
        }

        return $map;
    }

    /**
     * Hapus file temporary ZIP lama (> 1 jam).
     */
    private function cleanOldTempZipFiles()
    {
        try {
            $tempDir = storage_path('app/backup_temp');
            if (File::exists($tempDir)) {
                $files = File::files($tempDir);
                $expiryTime = time() - 3600; // 1 jam
                foreach ($files as $file) {
                    if ($file->getMTime() < $expiryTime) {
                        @File::delete($file->getPathname());
                    }
                }
            }
        } catch (\Throwable $e) {
            // Abaikan error cleanup
        }
    }

    /**
     * Format bytes menjadi human readable (KB, MB, GB).
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
