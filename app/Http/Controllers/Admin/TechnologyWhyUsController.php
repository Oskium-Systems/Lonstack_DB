<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\TechnologyWhyUs;
use Illuminate\Http\Request;

class TechnologyWhyUsController extends Controller
{
  /** Store a new "Why Choose Us" item */
  public function store(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The title is required.']);

    try {
      $validated['technology_id'] = $technology->id;
      TechnologyWhyUs::create($validated);

      return back()->with('success', '"Why Choose Us" item added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add item. Please try again.');
    }
  }

  /** Update an existing "Why Choose Us" item (PATCH) */
  public function update(Request $request, Technology $technology, TechnologyWhyUs $whyUs)
  {
    abort_if($whyUs->technology_id != $technology->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The title is required.']);

    try {
      $whyUs->update($validated);

      return back()->with('success', '"Why Choose Us" item updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update item. Please try again.');
    }
  }

  /** Delete a "Why Choose Us" item */
  public function destroy(Technology $technology, TechnologyWhyUs $whyUs)
  {
    abort_if($whyUs->technology_id != $technology->id, 403);

    try {
      $whyUs->delete();

      return back()->with('success', 'Item deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete item. Please try again.');
    }
  }
}
