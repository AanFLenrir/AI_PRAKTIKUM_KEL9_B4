<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuzzyApiController;

Route::post('/fuzzy-calculation', [FuzzyApiController::class, 'fuzzyCalculation']);
Route::post('/zscore-calculation', [FuzzyApiController::class, 'zscoreCalculation']);
Route::post('/calculate-all', [FuzzyApiController::class, 'calculateAll']);
