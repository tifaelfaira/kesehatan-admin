<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\CatatanImunisasiController;

// ===============================
// AUTH (Login & Register)
// ===============================
Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// ===============================
// ADMIN (Middleware Auth)
// ===============================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ROUTES YANG HANYA BISA DIAKSES SUPER ADMIN DAN ADMIN
    Route::middleware(['role:super_admin,admin'])->group(function () {
        // ROUTES USER (khusus super admin dan admin)
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
            Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        });
    });

    // ROUTES YANG BISA DIAKSES SEMUA ROLE (super_admin, admin, petugas)
    Route::middleware(['role:super_admin,admin,petugas'])->group(function () {
        // ROUTES JADWAL POSYANDU
        Route::prefix('jadwal')->group(function () {
            Route::get('/', [JadwalPosyanduController::class, 'index'])->name('jadwal.index');
            Route::get('/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
            Route::post('/', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');
            Route::get('/{jadwal_id}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');
            Route::get('/{jadwal_id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
            Route::put('/{jadwal_id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
            Route::delete('/{jadwal_id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');
            Route::post('/{jadwal_id}/media/{media}/delete', [JadwalPosyanduController::class, 'deleteMedia'])
                ->name('jadwal.delete-media');
        });

        // ROUTES POSYANDU
        Route::prefix('posyandu')->group(function () {
            Route::get('/', [PosyanduController::class, 'index'])->name('admin.posyandu.index');
            Route::get('/create', [PosyanduController::class, 'create'])->name('admin.posyandu.create');
            Route::post('/', [PosyanduController::class, 'store'])->name('admin.posyandu.store');
            Route::get('/{posyandu}', [PosyanduController::class, 'show'])->name('admin.posyandu.show');
            Route::get('/{posyandu}/edit', [PosyanduController::class, 'edit'])->name('admin.posyandu.edit');
            Route::put('/{posyandu}', [PosyanduController::class, 'update'])->name('admin.posyandu.update');
            Route::delete('/{posyandu}', [PosyanduController::class, 'destroy'])->name('admin.posyandu.destroy');
            Route::post('/{posyandu}/media/{media}/delete', [PosyanduController::class, 'deleteMedia'])
                ->name('admin.posyandu.delete-media');
        });

        // ROUTES CATATAN IMUNISASI
        Route::prefix('catatan-imunisasi')->group(function () {
            Route::get('/', [CatatanImunisasiController::class, 'index'])->name('admin.catatan-imunisasi.index');
            Route::get('/create', [CatatanImunisasiController::class, 'create'])->name('admin.catatan-imunisasi.create');
            Route::post('/', [CatatanImunisasiController::class, 'store'])->name('admin.catatan-imunisasi.store');
            Route::get('/{id}', [CatatanImunisasiController::class, 'show'])->name('admin.catatan-imunisasi.show');
            Route::get('/{id}/edit', [CatatanImunisasiController::class, 'edit'])->name('admin.catatan-imunisasi.edit');
            Route::put('/{id}', [CatatanImunisasiController::class, 'update'])->name('admin.catatan-imunisasi.update');
            Route::delete('/{id}', [CatatanImunisasiController::class, 'destroy'])->name('admin.catatan-imunisasi.destroy');
            Route::post('/{id}/media/{media}/delete', [CatatanImunisasiController::class, 'deleteMedia'])
                ->name('admin.catatan-imunisasi.delete-media');
        });

        // ROUTES LAINNYA
        Route::resource('warga', WargaController::class)->names([
            'index' => 'admin.warga.index',
            'create' => 'admin.warga.create',
            'store' => 'admin.warga.store',
            'edit' => 'admin.warga.edit',
            'update' => 'admin.warga.update',
            'destroy' => 'admin.warga.destroy',
            'show' => 'admin.warga.show',
        ]);

        Route::resource('kesehatan', KesehatanController::class)->names([
            'index' => 'admin.kesehatan.index',
            'create' => 'admin.kesehatan.create',
            'store' => 'admin.kesehatan.store',
            'edit' => 'admin.kesehatan.edit',
            'update' => 'admin.kesehatan.update',
            'destroy' => 'admin.kesehatan.destroy',
            'show' => 'admin.kesehatan.show',
        ]);

        Route::resource('layanan-posyandu', LayananPosyanduController::class)->names([
            'index' => 'admin.layanan-posyandu.index',
            'create' => 'admin.layanan-posyandu.create',
            'store' => 'admin.layanan-posyandu.store',
            'edit' => 'admin.layanan-posyandu.edit',
            'update' => 'admin.layanan-posyandu.update',
            'destroy' => 'admin.layanan-posyandu.destroy',
            'show' => 'admin.layanan-posyandu.show',
        ]);
    });
});

// ===============================
// DEFAULT ROUTE
// ===============================
Route::get('/', function () {
    return redirect()->route('auth.index');
});
