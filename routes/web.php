<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RabController;

Route::get('/', [RabController::class, 'landing'])->name('landing');
Route::get('/dashboard', [RabController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard/rab/calculate', [RabController::class, 'calculate'])->name('rab.calculate');
