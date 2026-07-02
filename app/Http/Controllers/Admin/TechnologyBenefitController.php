<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\TechnologyBenefit;
use Illuminate\Http\Request;

class TechnologyBenefitController extends Controller
{
  /** Store a new benefit item */
  public function store(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The benefit title is required.']);

    try {
      $validated['technology_id'] = $technology->id;
      TechnologyBenefit::create($validated);

      return back()->with('success', 'Benefit added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add benefit. Please try again.');
    }
  }

  /** Update an existing benefit (PATCH) */
  public function update(Request $request, Technology $technology, TechnologyBenefit $benefit)
  {
    abort_if($benefit->technology_id != $technology->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The benefit title is required.']);

    try {
      $benefit->update($validated);

      return back()->with('success', 'Benefit updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update benefit. Please try again.');
    }
  }

  /** Delete a benefit */
  public function destroy(Technology $technology, TechnologyBenefit $benefit)
  {
    abort_if($benefit->technology_id != $technology->id, 403);

    try {
      $benefit->delete();

      return back()->with('success', 'Benefit deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete benefit. Please try again.');
    }
  }
}
