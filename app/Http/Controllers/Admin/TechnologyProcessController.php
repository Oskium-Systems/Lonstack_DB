<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\TechnologyProcess;
use Illuminate\Http\Request;

class TechnologyProcessController extends Controller
{
  /** Store a new process step */
  public function store(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The step title is required.']);

    try {
      $validated['technology_id'] = $technology->id;
      TechnologyProcess::create($validated);

      return back()->with('success', 'Process step added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add process step. Please try again.');
    }
  }

  /** Update an existing process step (PATCH) */
  public function update(Request $request, Technology $technology, TechnologyProcess $process)
  {
    abort_if($process->technology_id != $technology->id, 403);

    $validated = $request->validate([
      'section_heading'  => 'nullable|string|max:255',
      'section_subtitle' => 'nullable|string|max:255',
      'title'            => 'required|string|max:255',
      'description'      => 'nullable|string',
      'sort_order'       => 'nullable|integer|min:0',
    ], ['title.required' => 'The step title is required.']);

    try {
      $process->update($validated);

      return back()->with('success', 'Process step updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update process step. Please try again.');
    }
  }

  /** Delete a process step */
  public function destroy(Technology $technology, TechnologyProcess $process)
  {
    abort_if($process->technology_id != $technology->id, 403);

    try {
      $process->delete();

      return back()->with('success', 'Process step deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete process step. Please try again.');
    }
  }
}
