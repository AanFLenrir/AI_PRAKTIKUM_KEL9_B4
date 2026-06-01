<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/** 
 * TO ADD NEW ROUTE AND ADD TO NAVIGATION:
 * 1. Create View at resources\views\admin
 * 2. Add New Route iniside the Group Function
 * 3. Add Route to Navigaton to resources\views\layouts\navigation.blade.php
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])
  ->prefix('/dashboard')
  ->group(function () {
        Route::get('/master-data', function () {
            return view('admin.master-data.index');
        })->name('dashboard.master-data');
});
