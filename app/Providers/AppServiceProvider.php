<?php

namespace App\Providers;

use App\Models\ServiceCategory;
use App\Models\Technology;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    //
  }

  public function boot(): void
  {
    Paginator::useBootstrap();

    // Share active service categories to all guest layout views.
    // Powers the nav mega menu without repeating the query per controller.
    View::composer('layouts.guest', function ($view) {
      $view->with('navCategories', ServiceCategory::with(['activeServices'])
        ->active()
        ->get());

      // Share active technologies for the nav Technologies dropdown
      $view->with('navTechnologies', Technology::active()->get());
    });
  }
}
