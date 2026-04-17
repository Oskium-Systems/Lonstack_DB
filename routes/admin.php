<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;


// ADMIN ROUTES
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth', 'can:access-admin-dashboard')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');


        // Profile Management
        Route::prefix('profile')
            ->name('profile.')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/', 'update')->name('update');
                Route::patch('/password', 'updatePassword')->name('password');
            });



        // Settings group
        Route::prefix('settings')
            ->name('settings.')
            ->controller(SettingsController::class)
            ->group(function () {

                Route::get('/', 'index')->name('index');
                Route::post('/', 'update')->name('update');
            });
    });
