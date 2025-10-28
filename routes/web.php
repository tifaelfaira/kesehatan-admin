<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalKesehatan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalKesehatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModulAController;
use App\Http\Controllers\ModulBController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| File ini berisi semua route utama aplikasi Laravel kamu.
| Gunakan route yang rapi agar mudah dipahami dan tidak tumpang tindih.
|--------------------------------------------------------------------------
*/

// Route default (mengarah ke halaman login atau dashboard)
Route::get('/', function () {
    return redirect('/admin/dashboard');
});

// ===============================
// AUTH (Login)
// ===============================
Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index'); // Form login
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); // Proses login
    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// ===============================
// ADMIN
// ===============================
Route::prefix('admin')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Jadwal Kesehatan
    Route::get('/jadwal', [JadwalKesehatan::class, 'index'])->name('admin.jadwal');

    // Resource lainnya
    Route::resource('jadwal', JadwalKesehatanController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('users', UserController::class)->names('admin.users');
});

// ===============================
// Dashboard (duplikat dihapus, cukup satu saja)
// ===============================
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// ===============================
// LOGOUT (PENTING UNTUK DARI SIDEBAR)
// ===============================
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/auth')->with('success', 'Anda berhasil logout.');
})->name('logout');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/auth');
})->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

// ====================== MODUL ADMIN ======================
Route::prefix('admin')->group(function () {
    Route::view('/modul-a', 'admin.modul-a')->name('admin.modul-a');
    Route::view('/modul-b', 'admin.modul-b')->name('admin.modul-b');
});


Route::prefix('admin')->group(function () {
    Route::get('/modul-a', function () {
        return view('admin.modul-a');
    });

    Route::get('/modul-b', function () {
        return view('admin.modul-b');
    });
});

Route::resource('/admin/modul-a', ModulAController::class);
