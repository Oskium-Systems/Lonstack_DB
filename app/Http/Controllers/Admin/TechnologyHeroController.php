<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\TechnologyHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechnologyHeroController extends Controller
{
  /**
   * Store a new hero for the technology (POST — first time).
   */
  public function store(Request $request, Technology $technology)
  {
    $validated = $request->validate([
      'headline'    => 'required|string|max:255',
      'description' => 'nullable|string',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'cta_label'   => 'nullable|string|max:100',
      'cta_url'     => 'nullable|string|max:255',
    ], [
      'image.mimes' => 'The image must be a JPEG, PNG, JPG, or WebP file.',
      'image.max'   => 'The image size must not exceed 2MB.',
    ]);

    $newImagePath = null;

    try {
      // Upload image with UUID filename to avoid collisions
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newImagePath = $file->storeAs('technologies/hero', $filename, 'public');
        $validated['image'] = $newImagePath;
      }

      $validated['technology_id'] = $technology->id;

      TechnologyHero::create($validated);

      return back()->with('success', 'Hero section saved successfully.');
    } catch (\Exception $e) {
      // Roll back uploaded file if DB write fails
      if ($newImagePath && Storage::disk('public')->exists($newImagePath)) {
        Storage::disk('public')->delete($newImagePath);
      }

      return back()->withInput()->with('error', 'Failed to save hero section. Please try again.');
    }
  }

  /**
   * Update the existing hero (PATCH).
   * Safe order: upload new → update DB → delete old.
   */
  public function update(Request $request, Technology $technology, TechnologyHero $hero)
  {
    abort_if($hero->technology_id != $technology->id, 403);

    $validated = $request->validate([
      'headline'    => 'required|string|max:255',
      'description' => 'nullable|string',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'cta_label'   => 'nullable|string|max:100',
      'cta_url'     => 'nullable|string|max:255',
    ], [
      'image.mimes' => 'The image must be a JPEG, PNG, JPG, or WebP file.',
      'image.max'   => 'The image size must not exceed 2MB.',
    ]);

    $newImagePath = null;
    $oldImagePath = $hero->image;

    try {
      // Step 1: Upload new image first
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $newImagePath = $file->storeAs('technologies/hero', $filename, 'public');
        $validated['image'] = $newImagePath;
      }

      // Step 2: Update DB
      $hero->update($validated);

      // Step 3: Delete old image only after successful DB update
      if ($newImagePath && $oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
        Storage::disk('public')->delete($oldImagePath);
      }

      return back()->with('success', 'Hero section updated successfully.');
    } catch (\Exception $e) {
      // Roll back new upload — old image is untouched
      if ($newImagePath && Storage::disk('public')->exists($newImagePath)) {
        Storage::disk('public')->delete($newImagePath);
      }

      return back()->withInput()->with('error', 'Failed to update hero section. Please try again.');
    }
  }
}
