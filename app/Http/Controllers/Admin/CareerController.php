<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    // ── List ──────────────────────────────────────────────────
    public function index()
    {
        $careers = Career::orderBy('sort_order')->orderByDesc('created_at')->paginate(15);
        return view('admin.career.index', compact('careers'));
    }

    // ── Store ─────────────────────────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:200',
            'slug'             => 'nullable|string|max:220|unique:careers,slug',
            'department'       => 'nullable|string|max:100',
            'location'         => 'nullable|string|max:150',
            'work_type'        => 'required|in:remote,onsite,hybrid',
            'employment_type'  => 'required|in:full-time,part-time,contract,internship,freelance',
            'experience_level' => 'nullable|string|max:80',
            'salary_range'     => 'nullable|string|max:100',
            'excerpt'          => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements'     => 'nullable|string',
            'nice_to_have'     => 'nullable|string',
            'benefits'         => 'nullable|string',
            'tags'             => 'nullable|string',
            'is_active'        => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'sort_order'       => 'nullable|integer|min:0',
            'deadline'         => 'nullable|date',
        ]);

        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['sort_order']  = $request->input('sort_order', 0);
        $data['tags']        = $this->parseTags($request->input('tags'));

        if (empty($data['slug'])) {
            unset($data['slug']); // let the model boot handle it
        }

        $career = Career::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Job vacancy created successfully.',
            'career'  => $this->careerData($career),
        ]);
    }

    // ── Update ────────────────────────────────────────────────
    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:200',
            'slug'             => "nullable|string|max:220|unique:careers,slug,{$career->id}",
            'department'       => 'nullable|string|max:100',
            'location'         => 'nullable|string|max:150',
            'work_type'        => 'required|in:remote,onsite,hybrid',
            'employment_type'  => 'required|in:full-time,part-time,contract,internship,freelance',
            'experience_level' => 'nullable|string|max:80',
            'salary_range'     => 'nullable|string|max:100',
            'excerpt'          => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'requirements'     => 'nullable|string',
            'nice_to_have'     => 'nullable|string',
            'benefits'         => 'nullable|string',
            'tags'             => 'nullable|string',
            'is_active'        => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'sort_order'       => 'nullable|integer|min:0',
            'deadline'         => 'nullable|date',
        ]);

        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['sort_order']  = $request->input('sort_order', 0);
        $data['tags']        = $this->parseTags($request->input('tags'));

        if (empty($data['slug'])) {
            $data['slug'] = $career->slug; // keep existing
        }

        $career->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Job vacancy updated successfully.',
            'career'  => $this->careerData($career->fresh()),
        ]);
    }

    // ── Toggle active ─────────────────────────────────────────
    public function toggleStatus(Career $career)
    {
        $career->update(['is_active' => !$career->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated.',
            'status'  => $career->is_active,
        ]);
    }

    // ── Delete ────────────────────────────────────────────────
    public function destroy(Career $career)
    {
        $career->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job vacancy deleted.',
        ]);
    }

    // ── Helpers ───────────────────────────────────────────────
    private function parseTags(?string $raw): ?array
    {
        if (empty($raw)) return null;
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    private function careerData(Career $c): array
    {
        return [
            'id'               => $c->id,
            'title'            => $c->title,
            'slug'             => $c->slug,
            'department'       => $c->department,
            'location'         => $c->location,
            'work_type'        => $c->work_type,
            'work_type_label'  => $c->work_type_label,
            'employment_type'  => $c->employment_type,
            'employment_label' => $c->employment_label,
            'experience_level' => $c->experience_level,
            'salary_range'     => $c->salary_range,
            'excerpt'          => $c->excerpt,
            'description'      => $c->description,
            'responsibilities' => $c->responsibilities,
            'requirements'     => $c->requirements,
            'nice_to_have'     => $c->nice_to_have,
            'benefits'         => $c->benefits,
            'tags'             => $c->tags ? implode(', ', $c->tags) : '',
            'is_active'        => $c->is_active ? 1 : 0,
            'is_featured'      => $c->is_featured ? 1 : 0,
            'sort_order'       => $c->sort_order,
            'deadline'         => $c->deadline?->format('Y-m-d'),
            'deadline_display' => $c->deadline?->format('d M Y'),
            'created_at'       => $c->created_at->format('d M Y'),
        ];
    }
}
