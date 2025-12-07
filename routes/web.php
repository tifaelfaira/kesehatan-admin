<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LayananPosyanduController;

// TAMBAHAN: Import controller baru
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
});

// ===============================
// ADMIN
// ===============================
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('jadwal', JadwalPosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('kesehatan', KesehatanController::class);

    // TAMBAHAN: CRUD Posyandu dengan nama route yang benar
    Route::resource('posyandu', PosyanduController::class)
        ->names([
            'index' => 'admin.posyandu.index',
            'create' => 'admin.posyandu.create',
            'store' => 'admin.posyandu.store',
            'edit' => 'admin.posyandu.edit',
            'update' => 'admin.posyandu.update',
            'destroy' => 'admin.posyandu.destroy',
            'show' => 'admin.posyandu.show',
        ]);
    
    // TAMBAHAN: CRUD Catatan Imunisasi dengan nama route yang benar
    Route::resource('catatan-imunisasi', CatatanImunisasiController::class)
        ->names([
            'index' => 'admin.catatan-imunisasi.index',
            'create' => 'admin.catatan-imunisasi.create',
            'store' => 'admin.catatan-imunisasi.store',
            'edit' => 'admin.catatan-imunisasi.edit',
            'update' => 'admin.catatan-imunisasi.update',
            'destroy' => 'admin.catatan-imunisasi.destroy',
            'show' => 'admin.catatan-imunisasi.show',
        ]);

    // CRUD Layanan Posyandu
    Route::resource('layanan-posyandu', LayananPosyanduController::class)
        ->names([
            'index' => 'admin.layanan-posyandu.index',
            'create' => 'admin.layanan-posyandu.create',
            'store' => 'admin.layanan-posyandu.store',
            'edit' => 'admin.layanan-posyandu.edit',
            'update' => 'admin.layanan-posyandu.update',
            'destroy' => 'admin.layanan-posyandu.destroy',
            'show' => 'admin.layanan-posyandu.show',
        ]);
});

// ===============================
// LOGOUT (POST ONLY)
// ===============================
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('auth.index')->with('success', 'Anda berhasil logout.');
})->name('logout');

// ===============================
// DEFAULT ROUTE
// ===============================
Route::get('/', function () {
    return redirect()->route('auth.index');
});