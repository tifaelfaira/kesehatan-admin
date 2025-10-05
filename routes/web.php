<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JadwalKesehatan;
use App\Http\Controllers\AuthController;


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