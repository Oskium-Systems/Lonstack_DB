<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\TechnologyAdvantage;
use Illuminate\Http\Request;

class TechnologyAdvantageController extends Controller
{
  /** Store a new advantage item */
  public function store(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The advantage title is required.']);

    try {
      $validated['technology_id'] = $technology->id;
      TechnologyAdvantage::create($validated);

      return back()->with('success', 'Advantage added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add advantage. Please try again.');
    }
  }

  /** Update an existing advantage (PATCH) */
  public function update(Request $request, Technology $technology, TechnologyAdvantage $advantage)
  {
    abort_if($advantage->technology_id != $technology->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The advantage title is required.']);

    try {
      $advantage->update($validated);

      return back()->with('success', 'Advantage updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update advantage. Please try again.');
    }
  }

  /** Delete an advantage */
  public function destroy(Technology $technology, TechnologyAdvantage $advantage)
  {
    abort_if($advantage->technology_id != $technology->id, 403);

    try {
      $advantage->delete();

      return back()->with('success', 'Advantage deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete advantage. Please try again.');
    }
  }
}
