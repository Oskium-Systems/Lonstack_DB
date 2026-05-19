<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;

class TechnologyDetailController extends Controller
{
  /**
   * Show the tabbed detail editor for a technology.
   * Eager-loads all section relationships to prevent N+1 queries.
   */
  public function show(Technology $technology)
  {
    try {
      $technology->load([
        'hero',
        'advantages',
        'benefits',
        'whyUs',
        'processes',
        'faqs',
      ]);

      return view('admin.technologies.detail', compact('technology'));
    } catch (\Exception $e) {
      return redirect()
        ->route('admin.technologies.index')
        ->with('error', 'Failed to load technology detail. Please try again.');
    }
  }
}
