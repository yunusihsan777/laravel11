<?php

use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

// Handle login
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Handle Logout
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KeputusanController;

use App\Http\Controllers\PerencanaanController;

use App\Http\Controllers\PengukuranController;

use App\Http\Controllers\PelaporanController;

use App\Http\Controllers\EvaluasiController;

use App\Http\Controllers\SakipwilController;

use App\Http\Controllers\SakipvalidasiController;

use App\Http\Controllers\KepatuhanController;

use App\Http\Controllers\ChatsupportController;

use App\Http\Controllers\PengumumanController;

Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

use App\Http\Controllers\AturanController;

use App\Http\Controllers\LiterasiController;

use App\Http\Controllers\FaqController;

use App\Http\Controllers\UbahpasswordController;
// Handle Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/keputusan', [KeputusanController::class, 'index'])->name('keputusan');
    Route::get('/perencanaan', [PerencanaanController::class, 'index'])->name('perencanaan');
    Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran');
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');
    Route::get('/sakipwil', [SakipwilController::class, 'index'])->name('sakipwil');
    Route::get('/sakipvalidasi', [SakipvalidasiController::class, 'index'])->name('sakipvalidasi');
    Route::get('/kepatuhan', [KepatuhanController::class, 'index'])->name('kepatuhan');
    Route::get('/chatsupport', [ChatsupportController::class, 'index'])->name('chatsupport');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/aturan', [AturanController::class, 'index'])->name('aturan');
    Route::get('/literasi', [LiterasiController::class, 'index'])->name('literasi');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/ubahpassword', [UbahpasswordController::class, 'index'])->name('ubahpassword');
});

// Handle file upload menu keputusan
use App\Http\Controllers\FileUploadController;
Route::get('/keputusan', [FileUploadController::class, 'index'])->name('keputusan');
Route::post('/upload-file', [FileUploadController::class, 'upload'])->name('upload.file');

// Handle file upload menu Renstra
use App\Http\Controllers\RenstraController;
Route::get('/renstra', [RenstraController::class, 'index'])->name('renstra.index');
Route::post('/upload-renstra', [RenstraController::class, 'uploadRenstra'])->name('upload.renstra');

