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

// Handle Auth
use App\Http\Controllers\DashboardController;
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/keputusan', [DashboardController::class, 'keputusan'])->name('keputusan');
    Route::get('/perencanaan', [DashboardController::class, 'perencanaan'])->name('perencanaan');
    Route::get('/pengukuran', [DashboardController::class, 'pengukuran'])->name('pengukuran');
    Route::get('/pelaporan', [DashboardController::class, 'pelaporan'])->name('pelaporan');
});

// Handle file upload menu keputusan
use App\Http\Controllers\FileUploadController;
Route::get('/keputusan', [FileUploadController::class, 'index'])->name('keputusan');
Route::post('/upload-file', [FileUploadController::class, 'upload'])->name('upload.file');

// Handle file upload menu Renstra
use App\Http\Controllers\RenstraController;
Route::get('/renstra', [RenstraController::class, 'index'])->name('renstra.index');
Route::post('/upload-renstra', [RenstraController::class, 'uploadRenstra'])->name('upload.renstra');

