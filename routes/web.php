<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfilController;

// =============================
// Login & Logout Routes
// =============================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// =============================
// Protected Routes (Setelah Login)
// =============================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    // Penumpang
    Route::resource('penumpang', PenumpangController::class);

    // Sopir
    Route::resource('sopir', SopirController::class);

    // Jadwal
    Route::resource('jadwal', JadwalController::class);

    // Pemesanan
    Route::resource('pemesanan', PemesananController::class);

    // Profile
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('index');
        Route::get('/edit', [ProfilController::class, 'edit'])->name('edit'); // ✅ Tambahkan ini
        Route::put('/update', [ProfilController::class, 'update'])->name('update');
    
        Route::get('/password', [ProfilController::class, 'password'])->name('password');
        Route::put('/password/update', [ProfilController::class, 'updatePassword'])->name('password.update');
    });
});