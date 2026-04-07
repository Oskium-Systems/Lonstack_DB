<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// page routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');

// Company menu routes
Route::get('/career', [PageController::class, 'career'])->name('career');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/press', [PageController::class, 'press'])->name('press');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/awards', [PageController::class, 'awards'])->name('awards');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
