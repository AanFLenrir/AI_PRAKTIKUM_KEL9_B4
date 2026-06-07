<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuzzyRuleController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\StatusGiziController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/** 
 * TO ADD NEW ROUTE AND ADD TO NAVIGATION:
 * 1. Create View at resources\views\admin
 * 2. Add New Route iniside the Group Function
 * 3. Add Route to Navigaton to resources\views\layouts\navigation.blade.php
 */

Route::middleware(['auth', 'role:admin'])
    ->prefix('/admin')
    ->group(function () {
        Route::get('/master-data', function () {
            return view('admin.master-data.index');
        })->name('dashboard.master-data');
        
        Route::resource('users', UserController::class);
    });

Route::middleware(['auth', 'role:admin|tenaga-kesehatan'])
    ->group(function () {
        Route::resource('status-gizi', StatusGiziController::class);
        Route::resource('imunisasi', ImunisasiController::class);

        // Rules Fuzzy (semua admin dan tenaga-kesehatan)
        Route::get('/fuzzy-rules', [FuzzyRuleController::class, 'index'])->name('fuzzy-rules');
    });

