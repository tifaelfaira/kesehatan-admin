<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\CatatanImunisasiController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN (CHECK LOGIN + ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware(['checkIsLogin'])->prefix('admin')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT (super admin + admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super_admin,admin'])->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    });

    /*
    |--------------------------------------------------------------------------
    | FITUR UTAMA (super_admin + admin + petugas)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super_admin,admin,petugas'])->group(function () {

        // ---- JADWAL POSYANDU ----
        Route::prefix('jadwal')->group(function () {
            Route::get('/', [JadwalPosyanduController::class, 'index'])->name('jadwal.index');
            Route::get('/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
            Route::post('/', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');

            Route::get('/{jadwal_id}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');
            Route::get('/{jadwal_id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
            Route::put('/{jadwal_id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
            Route::delete('/{jadwal_id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');

            Route::post('/{jadwal_id}/media/{media}/delete',
                [JadwalPosyanduController::class, 'deleteMedia'])->name('jadwal.delete-media');
        });

        // ---- LAYANAN POSYANDU ----
        Route::resource('layanan-posyandu', LayananPosyanduController::class)->names([
            'index' => 'admin.layanan-posyandu.index',
            'create' => 'admin.layanan-posyandu.create',
            'store' => 'admin.layanan-posyandu.store',
            'show' => 'admin.layanan-posyandu.show',
            'edit' => 'admin.layanan-posyandu.edit',
            'update' => 'admin.layanan-posyandu.update',
            'destroy' => 'admin.layanan-posyandu.destroy',
        ]);

        // ---- POSYANDU ----
        Route::resource('posyandu', PosyanduController::class)->names([
            'index' => 'admin.posyandu.index',
            'create' => 'admin.posyandu.create',
            'store' => 'admin.posyandu.store',
            'show' => 'admin.posyandu.show',
            'edit' => 'admin.posyandu.edit',
            'update' => 'admin.posyandu.update',
            'destroy' => 'admin.posyandu.destroy',
        ]);

        // ---- CATATAN IMUNISASI ----
        Route::resource('catatan-imunisasi', CatatanImunisasiController::class)->names([
            'index' => 'admin.catatan-imunisasi.index',
            'create' => 'admin.catatan-imunisasi.create',
            'store' => 'admin.catatan-imunisasi.store',
            'show' => 'admin.catatan-imunisasi.show',
            'edit' => 'admin.catatan-imunisasi.edit',
            'update' => 'admin.catatan-imunisasi.update',
            'destroy' => 'admin.catatan-imunisasi.destroy',
        ]);

        // Tambahkan route khusus untuk delete media
Route::delete('catatan-imunisasi/{id}/media/{media}', 
    [CatatanImunisasiController::class, 'deleteMedia']
)->name('admin.catatan-imunisasi.delete-media');

        // ---- WARGA ----
        Route::resource('warga', WargaController::class)->names([
            'index' => 'warga.index',
            'create' => 'warga.create',
            'store' => 'warga.store',
            'show' => 'warga.show',
            'edit' => 'warga.edit',
            'update' => 'warga.update',
            'destroy' => 'warga.destroy',
        ]);

        // ---- DATA KESEHATAN ----
        Route::resource('kesehatan', KesehatanController::class)->names([
            'index' => 'kesehatan.index',
            'create' => 'kesehatan.create',
            'store' => 'kesehatan.store',
            'show' => 'kesehatan.show',
            'edit' => 'kesehatan.edit',
            'update' => 'kesehatan.update',
            'destroy' => 'kesehatan.destroy',
        ]);
    });
});

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('auth.index');
});
