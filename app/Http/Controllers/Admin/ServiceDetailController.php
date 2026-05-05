<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceDetailController extends Controller
{
  /**
   * Show the tabbed detail editor for a service.
   * Eager-loads all section relationships to prevent N+1 queries.
   */
  public function show(Service $service): View|RedirectResponse
  {
    try {
      $service->load([
        'category',
        'hero',
        'benefits',
        'talkToUs',
        'processSteps',
        'techGroups.tags',
        'testimonials',
        'faqs',
        'relatedServices.relatedService.category',
      ]);

      // All other services for the "Related Services" select
      $allServices = Service::with('category')
        ->where('id', '!=', $service->id)
        ->orderBy('name')
        ->get();

      return view('admin.services.detail', compact('service', 'allServices'));
    } catch (\Exception $e) {
      return redirect()
        ->route('admin.services.index')
        ->with('error', 'Failed to load service detail. Please try again.');
    }
  }
}
