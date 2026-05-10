<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Core pages ──
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms-of-service');
Route::get('/privacy-policy', [PageController::class, 'policy'])->name('privacy-policy');

// ── Portfolio ──
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/load', [PageController::class, 'portfolioLoad'])->name('portfolio.load');
Route::get('/portfolio/{slug}', [PageController::class, 'portfolioDetails'])->name('portfolio-details');

// ── Blog ──
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [PageController::class, 'blogDetails'])->name('blog-details');
Route::post('/blog/{slug}/comment', [\App\Http\Controllers\BlogCommentController::class, 'store'])->name('blog.comment.store');

Route::middleware(['maintenance'])->group(function () {

  // Core pages (inside maintenance middleware)
  Route::get('/', [PageController::class, 'home'])->name('home');
  Route::get('/about', [PageController::class, 'about'])->name('about');
  Route::get('/services', [PageController::class, 'services'])->name('services');
  Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
  Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');
  Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');

  // Company
  Route::get('/career', [PageController::class, 'career'])->name('career');
  Route::get('/faq', [PageController::class, 'faq'])->name('faq');
  Route::get('/press', [PageController::class, 'press'])->name('press');
  Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
  Route::get('/awards', [PageController::class, 'awards'])->name('awards');

  // Dynamic service detail — single route handles all services by slug
  Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('services.show');

  // Technologies
  Route::get('/technologies/nodejs', [PageController::class, 'nodejs'])->name('tech.nodejs');
  Route::get('/technologies/reactjs', [PageController::class, 'reactjs'])->name('tech.reactjs');
  Route::get('/technologies/react-native', [PageController::class, 'reactNative'])->name('tech.react-native');
  Route::get('/technologies/solidity', [PageController::class, 'solidity'])->name('tech.solidity');
  Route::get('/technologies/solana', [PageController::class, 'solana'])->name('tech.solana');
  Route::get('/technologies/expressjs', [PageController::class, 'expressjs'])->name('tech.expressjs');
  Route::get('/technologies/laravel', [PageController::class, 'laravelTech'])->name('tech.laravel');
  Route::get('/technologies/nestjs', [PageController::class, 'nestjs'])->name('tech.nestjs');

  // Industries
  Route::get('/industries/oil-gas', [PageController::class, 'oilGas'])->name('industries.oil-gas');
  Route::get('/industries/logistics', [PageController::class, 'logistics'])->name('industries.logistics');
  Route::get('/industries/fintech', [PageController::class, 'fintech'])->name('industries.fintech');
  Route::get('/industries/retail', [PageController::class, 'retail'])->name('industries.retail');
  Route::get('/industries/real-estate', [PageController::class, 'realEstate'])->name('industries.real-estate');
  Route::get('/industries/travel-hospitality', [PageController::class, 'travelHospitality'])->name('industries.travel');
  Route::get('/industries/media-entertainment', [PageController::class, 'mediaEntertainment'])->name('industries.media');
  Route::get('/industries/healthcare', [PageController::class, 'healthcare'])->name('industries.healthcare');
  Route::get('/industries/elearning', [PageController::class, 'elearning'])->name('industries.elearning');
  Route::get('/industries/manufacturing', [PageController::class, 'manufacturing'])->name('industries.manufacturing');
});

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
