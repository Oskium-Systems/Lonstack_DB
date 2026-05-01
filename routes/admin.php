<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCommentController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTES
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth', 'can:access-admin-dashboard')
    ->group(function () {

        Route::get('dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');

        // Blog routes
        Route::get('blog/all', [BlogController::class, 'index'])->name('blog.all');
        Route::get('blog/search', [BlogController::class, 'search'])->name('blog.search');
        Route::post('blog', [BlogController::class, 'store'])->name('blog.store');

        // Blog Comment routes
        Route::get('blog/comments', [BlogCommentController::class, 'index'])->name('blog.comments');
        Route::get('blog/comments/search', [BlogCommentController::class, 'search'])->name('blog.comments.search');
        Route::patch('blog/comments/{blogComment}/status', [BlogCommentController::class, 'updateStatus'])->name('blog.comments.status');
        Route::delete('blog/comments/{blogComment}', [BlogCommentController::class, 'destroy'])->name('blog.comments.destroy');

        // Blog Category routes
        Route::get('blog/manage-categories', [BlogCategoryController::class, 'index'])->name('blog.manage-categories');
        Route::get('blog/manage-categories/search', [BlogCategoryController::class, 'search'])->name('blog.categories.search');
        Route::post('blog/manage-categories', [BlogCategoryController::class, 'store'])->name('blog.categories.store');
        Route::put('blog/manage-categories/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog.categories.update');
        Route::delete('blog/manage-categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog.categories.destroy');

        //blog route continues
        Route::get('blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
        Route::put('blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

        // Profile Management
        Route::prefix('profile')
            ->name('profile.')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/', 'update')->name('update');
                Route::patch('/password', 'updatePassword')->name('password');
            });

        // Settings
        Route::prefix('settings')
            ->name('settings.')
            ->controller(SettingsController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'update')->name('update');
            });
    });
