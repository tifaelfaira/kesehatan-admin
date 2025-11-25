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
use App\Http\Controllers\PelangganController; // TAMBAHKAN
use App\Http\Controllers\MultipleuploadsController; // TAMBAHKAN

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

    // TAMBAHKAN: Routes untuk Pelanggan
    Route::resource('pelanggan', PelangganController::class);

    // TAMBAHKAN: Routes untuk Multiple Uploads
    Route::post('/multipleuploads/store', [MultipleuploadsController::class, 'store'])->name('multipleuploads.store');
    Route::delete('/multipleuploads/{id}', [MultipleuploadsController::class, 'destroy'])->name('multipleuploads.destroy');

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