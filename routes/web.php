<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepController;
use App\Http\Controllers\SakipvalidasiController;
use App\Http\Controllers\SakipwilController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\KepatuhanController;
use App\Http\Controllers\ChatsupportController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\LiterasiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\KeloladataController;
use App\Http\Controllers\UbahpasswordController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DataLke;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\Indikator2025Controller;

Route::get('/spip', function () {
    return view('spip'); // resources/views/spip.blade.php
});

Route::get('/', function () {
    return view('auth/login');
});

//Handle Sicana
// Route::get('/', function () {
//     return redirect()->away('https://sicana.kejaksaan.go.id');
// });
// Route::get('/receive_token', [SicanaController::class, 'receiveToken']);

//Handle Maintenance
// Route::get('/', function () {
//     return view('maintenance');
// });
// Route::get('/receive_token', function () {
//     return view('maintenance');
// });

// Handle login
Route::get('/login-auto', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-auto', [LoginController::class, 'login']);

// Route::get('/login', function () {
//     return redirect()->away('https://sicana.kejaksaan.go.id');
// });

// Handle Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Middleware Auth
Route::middleware(['auth'])->group(function () {

    // === Pemilihan Tahun ===
    Route::get('/pilih-tahun', [TahunController::class, 'showTahunForm'])->name('pilih.tahun');
    Route::post('/pilih-tahun', [TahunController::class, 'pilihTahun'])->name('pilih_tahun');
    Route::post('/pilih2-tahun', [TahunController::class, 'setTahun'])->name('set.tahun');
    Route::post('/set-bulan', [TahunController::class, 'setBulan'])->name('set.bulan');

    // === Dashboard & Menu Utama ===
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kep', [KepController::class, 'index'])->name('kep');
    Route::post('kep', [KepController::class, 'store'])->name('kep.store');

    // === Perencanaan ===
    Route::get('/perencanaan', [PerencanaanController::class, 'index'])->name('perencanaan');
    Route::get('/perencanaan/indikator', [PerencanaanController::class, 'showIndikator'])->name('perencanaan.indikator');
    Route::post('/perencanaan/store', [PerencanaanController::class, 'store'])->name('perencanaan.store');
    Route::post('/target/store', [PerencanaanController::class, 'storetarget'])->name('target.store');

    Route::post('/perencanaan/upload-renstra', [PerencanaanController::class, 'uploadRenstra'])->name('upload.renstra');
    Route::post('/perencanaan/upload-iku', [PerencanaanController::class, 'uploadIku'])->name('upload.iku');
    Route::post('/perencanaan/upload-renja', [PerencanaanController::class, 'uploadRenja'])->name('upload.renja');
    Route::post('/perencanaan/upload-rkakl', [PerencanaanController::class, 'uploadRkakl'])->name('upload.rkakl');
    Route::post('/perencanaan/upload-renaksi', [PerencanaanController::class, 'uploadRenaksi'])->name('upload.renaksi');
    Route::post('/upload-pk', [PerencanaanController::class, 'uploadPK'])->name('upload.pk');
    Route::post('/upload-dipa', [PerencanaanController::class, 'uploadDipa'])->name('upload.dipa');

    // === Pengukuran ===
    Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran');
    Route::get('/pengukuran/form/{id}', [PengukuranController::class, 'form'])->name('pengukuran.form');
    Route::get('/pengukuran/indikator/{id_bidang}', [PengukuranController::class, 'getIndikatorByBidang'])->name('pengukuran.getIndikatorByBidang');
    Route::get('/pengukuran/indikator-nama', [PengukuranController::class, 'getIndikatorNama'])->name('pengukuran.getIndikatorNama');
    Route::get('/get-indikator/{id_bidang}', [PengukuranController::class, 'getIndikatorByBidang']);
    Route::get('/pengukuran/{id_bidang}/{sub_indikator}', [PengukuranController::class, 'getDataByBidangAndSubIndikator'])->name('pengukuran.getDataByBidangAndSubIndikator');
    Route::get('/get-pengukuran/{indikator_id}', [PengukuranController::class, 'getPengukuran'])->name('pengukuran.getPengukuran');
    Route::post('/simpan-pengukuran', [PengukuranController::class, 'store'])->name('pengukuran.store');
    Route::post('/pengukuran/update-inline', [PengukuranController::class, 'updateInline'])->name('pengukuran.updateInline');
    Route::post('/pengukuran/update-bulanan', [PengukuranController::class, 'updateBulanan'])->name('pengukuran.updateBulanan');
    Route::get('/get-subindikator-by-id/{id}', [PengukuranController::class, 'getIndikatorNama']);
     Route::get('/get-subindikator/{rumpun}', [PelaporanController::class, 'getSubIndikator']);

    // === Pelaporan ===
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::post('/upload/lkjip', [PelaporanController::class, 'uploadLkjip'])->name('upload.lkjip');
    Route::delete('/delete/lkjip/{id}', [PelaporanController::class, 'deleteLkjip'])->name('delete.lkjip');
    Route::post('/upload/rapat-staff-eka', [PelaporanController::class, 'uploadRapatStaffEka'])->name('upload.rapat_staff_eka');
    Route::get('/pelaporan/subindikator/{rumpun}', [PelaporanController::class, 'getSubIndikator2']);
    Route::post('/pelaporan/simpan-keterangan', [PelaporanController::class, 'simpanKeterangan']);

    // === Evaluasi ===
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');
    Route::post('/upload/lhe-akip', [EvaluasiController::class, 'uploadLheAkip'])->name('upload.lhe_akip');
    Route::post('/upload/tl-lhe-akip', [EvaluasiController::class, 'uploadTlLheAkip'])->name('upload.tl_lhe_akip');
    Route::post('/upload/monev-renaksi', [EvaluasiController::class, 'uploadMonevRenaksi'])->name('upload.monev_renaksi');
    Route::post('/dokumen/verifikasi', [EvaluasiController::class, 'verifikasi'])->name('verifikasi.dokumen');
    Route::post('/dokumen/upload', [EvaluasiController::class, 'upload'])->name('upload.dokumen');

    // === Monitoring ===
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/monitoring/search-satker', [MonitoringController::class, 'searchSatker'])->name('monitoring.searchSatker');
    Route::get('/monitoring/bidang/{idSatker}', [MonitoringController::class, 'getBidang'])->name('monitoring.getBidang');
    Route::get('/monitoring/subindikator/{rumpun}/{id_satker}', [MonitoringController::class, 'getSubIndikator'])->name('monitoring.subindikator');
    Route::get('/monitoring/subindikator2/{rumpun}', [MonitoringController::class, 'getSubIndikator2']);
    Route::get('/monitoring/capaian-saspro-all', [MonitoringController::class, 'capaianSasproAll'])->name('capaian.saspro.all');
    Route::get('/monitoring/capaian-saspro-per-kejati', [MonitoringController::class, 'capaianSasproPerKejati'])->name('capaian.saspro.perkejati');
    Route::get('/capaian/saspro/all/{id_satker}/{id_kejati}/{tahun}/{level}', [MonitoringController::class, 'capaianSasproAll'])->name('capaian.saspro.all');

    // === Data LKE ===
    Route::get('/evaluasi-akip', [DataLke::class, 'index'])->name('dataLke');
    Route::get('/upload/bukti-dukung', [DataLke::class, 'showUploadForm'])->name('upload_buktidukung');
    Route::post('/upload/bukti-dukung', [DataLke::class, 'upload'])->name('upload.store');
    Route::get('/upload/files/{id}', [DataLke::class, 'getUploadedFiles'])->name('upload.files');
    Route::get('/cekbdeval-lke/{kode}', [DataLke::class, 'cekBuktiDukung'])->name('cekbdeval_lke');

    // === Pengumuman ===
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    // === Aturan ===
    Route::get('/aturan/create', [AturanController::class, 'create'])->name('aturan.create');
    Route::get('/aturan', [AturanController::class, 'index'])->name('aturan');
    // === Kelola Data ===
    Route::get('/keloladata', [KeloladataController::class, 'index'])->name('keloladata');
    Route::post('/keloladata/indikator', [KeloladataController::class, 'indikator'])->name('indikator.store');
    Route::post('/keloladata/bidang', [KeloladataController::class, 'bidang'])->name('bidang.store');
    Route::post('/keloladata/saspro', [KeloladataController::class, 'saspro'])->name('saspro.store');
    Route::post('/keloladata/storeOrUpdateBidang', [KeloladataController::class, 'storeOrUpdateBidang'])->name('bidang.storeOrUpdateBidang');
    Route::get('/keloladata/edit/{id}', [KeloladataController::class, 'edit'])->name('bidang.edit');
    Route::delete('/keloladata/destroy/{id}', [KeloladataController::class, 'destroy'])->name('bidang.destroy');
    Route::post('/keloladata/update/{id}', [KeloladataController::class, 'sasproUpdate'])->name('saspro.update');
    Route::delete('/keloladata/delete/{id}', [KeloladataController::class, 'destroySaspro'])->name('saspro.destroy');
    Route::post('/indikator/store', [KeloladataController::class, 'storeIndikator'])->name('indikator.store');
    Route::post('/indikator/delete/{id}', [KeloladataController::class, 'deleteIndikator'])->name('indikator.delete');
    Route::post('/indikator/update/{id}', [KeloladataController::class, 'updateIndikator'])->name('indikator.update');

    // === Fitur Lain ===
    Route::get('/sakipwil', [SakipwilController::class, 'index'])->name('sakipwil');
    Route::get('/sakipvalidasi', [SakipvalidasiController::class, 'index'])->name('sakipvalidasi');
    Route::get('/chatsupport', [ChatsupportController::class, 'index'])->name('chatsupport');
    Route::get('/literasi', [LiterasiController::class, 'index'])->name('literasi');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/ubahpassword', [UbahpasswordController::class, 'index'])->name('ubahpassword');
    Route::put('/password/update', [UbahpasswordController::class, 'updatePassword'])->name('password.update');

    // === Kriteria & Indikator 2025 ===
    Route::get('/input-kriteria', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/input-kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/get-subkomponen/{id}', [KriteriaController::class, 'getSubkomponen']);
    // Route::get('/indikator2025', [Indikator2025Controller::class, 'index'])->name('indikator2025.index');
    // Route::post('/pengukuran2025/store', [Indikator2025Controller::class, 'store'])->name('pengukuran2025.store');
});
