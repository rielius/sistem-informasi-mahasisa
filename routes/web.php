<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
    
    Route::get('/mahasiswa/export/csv', [MahasiswaController::class, 'exportCsv']);
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('mahasiswa', MahasiswaController::class);
});
