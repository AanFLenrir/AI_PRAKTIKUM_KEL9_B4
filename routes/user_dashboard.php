<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistikController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    // Grafik & Statistik (semua role login)
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    
    // Dashboard Stats API
    Route::get('/dashboard/stats', [\App\Http\Controllers\DashboardApiController::class, 'getStats'])->name('dashboard.stats');

    // Kelola Balita (Orang Tua & Nakes)
    Route::resource('balita', \App\Http\Controllers\BalitaController::class)->only(['index', 'store', 'update', 'destroy']);

    // Analisis Gizi
    Route::get('/analisis-gizi', [\App\Http\Controllers\AnalisisFuzzyController::class, 'index'])->name('analisis-fuzzy.index');
    Route::get('/analisis-gizi/lakukan', [\App\Http\Controllers\AnalisisFuzzyController::class, 'create'])->name('analisis-fuzzy.create');
    Route::get('/analisis-gizi/hasil', [\App\Http\Controllers\AnalisisFuzzyController::class, 'hasil'])->name('analisis-fuzzy.hasil');
    Route::get('/analisis-gizi/balita/{id}', [\App\Http\Controllers\AnalisisFuzzyController::class, 'getBalita'])->name('analisis-fuzzy.balita');
    Route::post('/analisis-gizi/simpan', [\App\Http\Controllers\AnalisisFuzzyController::class, 'store'])->name('analisis-fuzzy.store');
    Route::get('/analisis-gizi/{id}', [\App\Http\Controllers\AnalisisFuzzyController::class, 'show'])->name('analisis-fuzzy.show');
});



