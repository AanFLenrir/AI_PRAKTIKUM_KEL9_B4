<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusGiziController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\FuzzyRuleController;
use App\Http\Controllers\StatistikController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================== MASTER DATA, RULES FUZZY, STATISTIK =====================

Route::middleware(['auth'])->group(function () {

    // Halaman utama Master Data (card) - hanya untuk admin & tenaga kesehatan
    Route::get('/admin/master-data', function () {
        return view('admin.master-data.index');
    })->name('master-data.index')->middleware('role:admin|tenaga-kesehatan');

    // CRUD User (hanya admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // CRUD Status Gizi (admin & tenaga kesehatan)
    Route::middleware(['role:admin|tenaga-kesehatan'])->group(function () {
        Route::resource('status-gizi', StatusGiziController::class);
    });

    // CRUD Imunisasi (admin & tenaga kesehatan)
    Route::middleware(['role:admin|tenaga-kesehatan'])->group(function () {
        Route::resource('imunisasi', ImunisasiController::class);
    });

    // Rules Fuzzy (semua role login)
    Route::get('/fuzzy-rules', [FuzzyRuleController::class, 'index'])->name('fuzzy-rules');

    // Grafik & Statistik (semua role login)
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
});

// ===================== AKHIR MASTER DATA =====================

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/user_dashboard.php';