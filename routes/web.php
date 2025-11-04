<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalKesehatanController;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\KesehatanController;

=======
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
>>>>>>> 68a64d7

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============================
// AUTH (Login)
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
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Resources - PASTIKAN SEMUA DI DALAM PREFIX ADMIN
    Route::resource('jadwal', JadwalKesehatanController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class); // INI HARUS DI DALAM PREFIX ADMIN
});

// ===============================
// LOGOUT
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

// ===============================
// DEFAULT ROUTE
// ===============================
Route::get('/', function () {
    return view('pages.auth.login-form');
});
<<<<<<< HEAD

Route::prefix('admin')->group(function () {
    Route::get('/jadwal', [JadwalKesehatan::class, 'index']);
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/jadwal', [JadwalKesehatan::class, 'index']);
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/jadwal', [AdminController::class, 'jadwal']);

// Route untuk login
Route::get('/auth', [AuthController::class, 'index']); // Menampilkan form login
Route::post('/auth/login', [AuthController::class, 'login']); // Proses login

// Route untuk admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/jadwal', [AdminController::class, 'jadwal']);

Route::resource('kesehatan', KesehatanController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Jadwal
Route::get('/jadwal', function () {
    return view('admin.jadwal');
})->name('jadwal');

// CRUD Data Kesehatan
Route::resource('kesehatan', App\Http\Controllers\KesehatanController::class);

Route::get('/kesehatan/{id}/edit', [KesehatanController::class, 'edit'])->name('kesehatan.edit');


=======
>>>>>>> 68a64d7
