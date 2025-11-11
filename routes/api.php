<?php

use App\Http\Controllers\LoginMonitorController;
use Illuminate\Support\Facades\Route;

Route::get('/login-monitor', [LoginMonitorController::class, 'show'])
    ->name('login-monitor.show');

Route::post('/login-monitor', [LoginMonitorController::class, 'store'])
    ->name('login-monitor.store');