<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStackGroup;
use App\Models\TechStackItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechStackItemController extends Controller
{
  /**
   * Store a new tech stack item under a group.
   * Icon is uploaded as an image file (PNG/SVG/WebP).
   */
  public function store(Request $request, TechStackGroup $group)
  {
    $validated = $request->validate([
      'name'       => 'required|string|max:100',
      'icon'       => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:512',
      'sort_order' => 'nullable|integer|min:0',
    ], [
      'name.required' => 'The item name is required.',
      'icon.mimes'    => 'Icon must be a PNG, JPG, WebP, or SVG file.',
      'icon.max'      => 'Icon must not exceed 512KB.',
    ]);

    $newIconPath = null;

    try {
      // Upload icon with UUID filename
      if ($request->hasFile('icon')) {
        $file = $request->file('icon');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newIconPath = $file->storeAs('tech-stack', $filename, 'public');
        $validated['icon'] = $newIconPath;
      }

      $validated['tech_stack_group_id'] = $group->id;
      $validated['is_active']           = $request->boolean('is_active', true);

      TechStackItem::create($validated);

      return back()->with('success', 'Tech stack item added successfully.');
    } catch (\Exception $e) {
      if ($newIconPath && Storage::disk('public')->exists($newIconPath)) {
        Storage::disk('public')->delete($newIconPath);
      }

      return back()->withInput()->with('error', 'Failed to add item. Please try again.');
    }
  }

  /**
   * Update an existing tech stack item (PATCH).
   * Safe order: upload new icon → update DB → delete old icon.
   */
  public function update(Request $request, TechStackGroup $group, TechStackItem $item)
  {
    abort_if($item->tech_stack_group_id !== $group->id, 403);

    $validated = $request->validate([
      'name'       => 'required|string|max:100',
      'icon'       => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:512',
      'sort_order' => 'nullable|integer|min:0',
    ], [
      'name.required' => 'The item name is required.',
      'icon.mimes'    => 'Icon must be a PNG, JPG, WebP, or SVG file.',
      'icon.max'      => 'Icon must not exceed 512KB.',
    ]);

    $newIconPath = null;
    $oldIconPath = $item->icon;

    try {
      // Step 1: Upload new icon before touching the DB
      if ($request->hasFile('icon')) {
        $file = $request->file('icon');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newIconPath = $file->storeAs('tech-stack', $filename, 'public');
        $validated['icon'] = $newIconPath;
      }

      $validated['is_active'] = $request->boolean('is_active', false);

      // Step 2: Update DB
      $item->update($validated);

      // Step 3: Delete old icon only after successful DB update
      if ($newIconPath && $oldIconPath && Storage::disk('public')->exists($oldIconPath)) {
        Storage::disk('public')->delete($oldIconPath);
      }

      return back()->with('success', 'Item updated successfully.');
    } catch (\Exception $e) {
      if ($newIconPath && Storage::disk('public')->exists($newIconPath)) {
        Storage::disk('public')->delete($newIconPath);
      }

      return back()->withInput()->with('error', 'Failed to update item. Please try again.');
    }
  }

  /** Delete a tech stack item and its icon file */
  public function destroy(TechStackGroup $group, TechStackItem $item)
  {
    abort_if($item->tech_stack_group_id !== $group->id, 403);

    try {
      // Delete icon file from storage
      if ($item->icon && Storage::disk('public')->exists($item->icon)) {
        Storage::disk('public')->delete($item->icon);
      }

      $item->delete();

      return back()->with('success', 'Item deleted.');
    } catch (\Exception $e) {
      return back()->with('error', 'Failed to delete item. Please try again.');
    }
  }
}
