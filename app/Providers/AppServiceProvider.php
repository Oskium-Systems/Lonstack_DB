<?php

namespace App\Providers;

use App\Models\ServiceCategory;
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

    // Share active service categories (with their active services) to all
    // guest layout views. This powers the nav mega menu on every page
    // without repeating the query in every controller method.
    // View::composer runs the query only when the layout is actually rendered.
    View::composer('layouts.guest', function ($view) {
      $view->with('navCategories', ServiceCategory::with(['activeServices'])
        ->active()
        ->get());
    });
  }
}
