<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Terproteksi (Harus Login)
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Kasir & Pelanggan (Bisa diakses Admin & Kasir)
    Route::resource('customers', CustomerController::class);

    Route::resource('transactions', TransactionController::class);

    // Fitur Khusus Admin / Pemilik Toko
    Route::resource('services', ServiceController::class);
    Route::resource('users', UserController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
