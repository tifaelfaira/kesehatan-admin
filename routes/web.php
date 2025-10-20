<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalKesehatan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KesehatanController;



//Route default welcome bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

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


