<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalKesehatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('jadwal', JadwalKesehatanController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('kesehatan', KesehatanController::class);
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


