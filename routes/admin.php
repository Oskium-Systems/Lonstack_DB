<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceBenefitController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceDetailController;
use App\Http\Controllers\Admin\ServiceFaqController;
use App\Http\Controllers\Admin\ServiceHeroController;
use App\Http\Controllers\Admin\ServiceProcessController;
use App\Http\Controllers\Admin\ServiceRelatedController;
use App\Http\Controllers\Admin\ServiceTalkToUsController;
use App\Http\Controllers\Admin\ServiceTechGroupController;
use App\Http\Controllers\Admin\ServiceTechTagController;
use App\Http\Controllers\Admin\ServiceTestimonialController;
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



    // Services
    Route::prefix('services')
      ->name('services.')
      ->group(function () {

        // ── Categories ──
        Route::resource('categories', ServiceCategoryController::class)
          ->only(['index', 'store', 'update', 'destroy'])
          ->parameters(['categories' => 'serviceCategory']);

        // ── Services list ──
        // Explicit routes instead of resource('/') to avoid empty-string
        // parameter conflicts and ensure {service}/detail resolves correctly.
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::patch('{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('{service}', [ServiceController::class, 'destroy'])->name('destroy');

        // ── Service Detail Editor ──
        // Declared after index/store but before the slug-based section routes
        // so {service}/detail doesn't get swallowed by {service} PATCH/DELETE.
        Route::get('{service}/detail', [ServiceDetailController::class, 'show'])
          ->name('detail');

        // ── Hero (one per service) ──
        Route::post('{service}/hero', [ServiceHeroController::class, 'store'])
          ->name('hero.store');
        Route::patch('{service}/hero/{hero}', [ServiceHeroController::class, 'update'])
          ->name('hero.update');

        // ── Benefits ──
        Route::post('{service}/benefits', [ServiceBenefitController::class, 'store'])
          ->name('benefits.store');
        Route::patch('{service}/benefits/{benefit}', [ServiceBenefitController::class, 'update'])
          ->name('benefits.update');
        Route::delete('{service}/benefits/{benefit}', [ServiceBenefitController::class, 'destroy'])
          ->name('benefits.destroy');

        // ── Talk To Us (one per service) ──
        Route::post('{service}/talk', [ServiceTalkToUsController::class, 'store'])
          ->name('talk.store');
        Route::patch('{service}/talk/{talkToUs}', [ServiceTalkToUsController::class, 'update'])
          ->name('talk.update');

        // ── Process Steps ──
        Route::post('{service}/process', [ServiceProcessController::class, 'store'])
          ->name('process.store');
        Route::patch('{service}/process/{step}', [ServiceProcessController::class, 'update'])
          ->name('process.update');
        Route::delete('{service}/process/{step}', [ServiceProcessController::class, 'destroy'])
          ->name('process.destroy');

        // ── Tech Groups ──
        Route::post('{service}/techgroups', [ServiceTechGroupController::class, 'store'])
          ->name('techgroups.store');
        Route::patch('{service}/techgroups/{techGroup}', [ServiceTechGroupController::class, 'update'])
          ->name('techgroups.update');
        Route::delete('{service}/techgroups/{techGroup}', [ServiceTechGroupController::class, 'destroy'])
          ->name('techgroups.destroy');

        // ── Tech Tags (nested under group) ──
        Route::post('{service}/techgroups/{techGroup}/tags', [ServiceTechTagController::class, 'store'])
          ->name('techtags.store');
        Route::delete('{service}/techgroups/{techGroup}/tags/{tag}', [ServiceTechTagController::class, 'destroy'])
          ->name('techtags.destroy');

        // ── Testimonials ──
        Route::post('{service}/testimonials', [ServiceTestimonialController::class, 'store'])
          ->name('testimonials.store');
        Route::patch('{service}/testimonials/{testimonial}', [ServiceTestimonialController::class, 'update'])
          ->name('testimonials.update');
        Route::delete('{service}/testimonials/{testimonial}', [ServiceTestimonialController::class, 'destroy'])
          ->name('testimonials.destroy');

        // ── FAQs ──
        Route::post('{service}/faqs', [ServiceFaqController::class, 'store'])
          ->name('faqs.store');
        Route::patch('{service}/faqs/{faq}', [ServiceFaqController::class, 'update'])
          ->name('faqs.update');
        Route::delete('{service}/faqs/{faq}', [ServiceFaqController::class, 'destroy'])
          ->name('faqs.destroy');

        // ── Related Services ──
        Route::post('{service}/related', [ServiceRelatedController::class, 'store'])
          ->name('related.store');
        Route::delete('{service}/related/{related}', [ServiceRelatedController::class, 'destroy'])
          ->name('related.destroy');
      });
  });
