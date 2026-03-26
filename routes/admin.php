<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;


// ADMIN ROUTES
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth', 'can:access-admin-dashboard')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');
    });
