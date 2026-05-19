<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStackGroup;
use Illuminate\Http\Request;

class TechStackGroupController extends Controller
{
  /**
   * Show the global "Technologies We Use" management page.
   * Groups with their items — shared across all technology pages.
   */
  public function index()
  {
    $groups = TechStackGroup::with('items')->orderBy('sort_order')->get();

    return view('admin.technologies.tech-stack', compact('groups'));
  }

  /** Store a new group */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name'       => 'required|string|max:150',
      'sort_order' => 'nullable|integer|min:0',
    ], ['name.required' => 'The group name is required.']);

    try {
      $validated['is_active'] = $request->boolean('is_active', true);
      TechStackGroup::create($validated);

      return back()->with('success', 'Tech stack group added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to add group. Please try again.');
    }
  }

  /** Update an existing group (PATCH) */
  public function update(Request $request, TechStackGroup $group)
  {
    $validated = $request->validate([
      'name'       => 'required|string|max:150',
      'sort_order' => 'nullable|integer|min:0',
    ], ['name.required' => 'The group name is required.']);

    try {
      $validated['is_active'] = $request->boolean('is_active', false);
      $group->update($validated);

      return back()->with('success', 'Group updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()->with('error', 'Failed to update group. Please try again.');
    }
  }

  /** Delete a group (cascades to its items via DB constraint) */
  public function destroy(TechStackGroup $group)
  {
    try {
      $group->delete();

      return back()->with('success', 'Group and its items deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete group. Please try again.');
    }
  }
}
