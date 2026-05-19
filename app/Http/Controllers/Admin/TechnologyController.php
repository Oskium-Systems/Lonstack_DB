<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
  /**
   * List all technologies for the admin index page.
   */
  public function index()
  {
    $technologies = Technology::orderBy('sort_order')->paginate(20);

    return view('admin.technologies.index', compact('technologies'));
  }

  /**
   * Store a new technology.
   * Slug is auto-generated from name if not provided.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'              => 'required|string|max:150',
      'icon'              => 'nullable|string|max:100',
      'short_description' => 'nullable|string|max:120',
      'meta_title'        => 'nullable|string|max:255',
      'meta_description'  => 'nullable|string',
      'sort_order'        => 'nullable|integer|min:0',
    ], [
      'name.required' => 'The technology name is required.',
    ]);

    try {
      $validated['slug']      = Str::slug($validated['name']);
      $validated['is_active'] = $request->boolean('is_active', true);

      Technology::create($validated);

      return back()->with('success', 'Technology created successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to create technology. Please try again.');
    }
  }

  /**
   * Update an existing technology.
   */
  public function update(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'name'              => 'required|string|max:150',
      'icon'              => 'nullable|string|max:100',
      'short_description' => 'nullable|string|max:120',
      'meta_title'        => 'nullable|string|max:255',
      'meta_description'  => 'nullable|string',
      'sort_order'        => 'nullable|integer|min:0',
    ], [
      'name.required' => 'The technology name is required.',
    ]);

    try {
      $validated['slug']      = Str::slug($validated['name']);
      $validated['is_active'] = $request->boolean('is_active', false);

      $technology->update($validated);

      return back()->with('success', 'Technology updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update technology. Please try again.');
    }
  }

  /**
   * Delete a technology and all its related sections (cascade).
   */
  public function destroy(Technology $technology)
  {
    try {
      $technology->delete();

      return back()->with('success', 'Technology deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete technology. Please try again.');
    }
  }
}
