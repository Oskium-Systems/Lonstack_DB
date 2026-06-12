<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->paginate(15);
        return view('admin.team.index', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:150',
            'slug'       => 'nullable|string|max:170|unique:teams,slug',
            'role'       => 'required|string|max:150',
            'department' => 'nullable|string|max:100',
            'photo'      => 'nullable|image|max:2048',
            'bio'        => 'nullable|string|max:1000',
            'experience' => 'nullable|string|max:60',
            'facebook'   => 'nullable|url|max:300',
            'twitter'    => 'nullable|url|max:300',
            'linkedin'   => 'nullable|url|max:300',
            'youtube'    => 'nullable|url|max:300',
            'github'     => 'nullable|url|max:300',
            'website'    => 'nullable|url|max:300',
            'sort_order' => 'nullable|integer|min:0',
            // is_active intentionally excluded — checkbox sends nothing when unchecked,
            // handled below with $request->boolean()
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('team', 'public');
        }

        try {
            $team = Team::create([
                'name'       => $request->name,
                'slug'       => $request->slug ?: null,
                'role'       => $request->role,
                'department' => $request->department,
                'photo'      => $photoPath,
                'bio'        => $request->bio,
                'experience' => $request->experience,
                'facebook'   => $request->facebook,
                'twitter'    => $request->twitter,
                'linkedin'   => $request->linkedin,
                'youtube'    => $request->youtube,
                'github'     => $request->github,
                'website'    => $request->website,
                'is_active'  => $request->boolean('is_active', true),
                'sort_order' => $request->sort_order ?? 0,
            ]);
        } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'A team member with this name already exists. Please use a different name.',
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'A team member with this name already exists.',
                ], 422);
            }
            throw $e;
        }

        return response()->json([
            'success' => true,
            'message' => 'Team member added successfully.',
            'team'    => $this->teamData($team),
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'       => 'required|string|max:150',
            'slug'       => ['nullable', 'string', 'max:170', Rule::unique('teams', 'slug')->ignore($team->id)],
            'role'       => 'required|string|max:150',
            'department' => 'nullable|string|max:100',
            'photo'      => 'nullable|image|max:2048',
            'bio'        => 'nullable|string|max:1000',
            'experience' => 'nullable|string|max:60',
            'facebook'   => 'nullable|url|max:300',
            'twitter'    => 'nullable|url|max:300',
            'linkedin'   => 'nullable|url|max:300',
            'youtube'    => 'nullable|url|max:300',
            'github'     => 'nullable|url|max:300',
            'website'    => 'nullable|url|max:300',
            'sort_order' => 'nullable|integer|min:0',
            // is_active excluded — checkbox sends nothing when unchecked
        ]);

        $photoPath = $team->photo;
        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $photoPath = $request->file('photo')->store('team', 'public');
        }

        $team->update([
            'name'       => $request->name,
            'slug'       => $request->slug ?: $team->slug,
            'role'       => $request->role,
            'department' => $request->department,
            'photo'      => $photoPath,
            'bio'        => $request->bio,
            'experience' => $request->experience,
            'facebook'   => $request->facebook,
            'twitter'    => $request->twitter,
            'linkedin'   => $request->linkedin,
            'youtube'    => $request->youtube,
            'github'     => $request->github,
            'website'    => $request->website,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully.',
            'team'    => $this->teamData($team),
        ]);
    }

    public function toggleStatus(Team $team)
    {
        $team->update(['is_active' => !$team->is_active]);

        return response()->json([
            'success'   => true,
            'message'   => 'Status updated.',
            'is_active' => $team->is_active,
        ]);
    }

    public function destroy(Team $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return response()->json([
            'success' => true,
            'message' => 'Team member deleted successfully.',
        ]);
    }

    private function teamData(Team $team): array
    {
        return [
            'id'         => $team->id,
            'name'       => $team->name,
            'slug'       => $team->slug,
            'role'       => $team->role,
            'department' => $team->department,
            'bio'        => $team->bio,
            'experience' => $team->experience,
            'facebook'   => $team->facebook,
            'twitter'    => $team->twitter,
            'linkedin'   => $team->linkedin,
            'youtube'    => $team->youtube,
            'github'     => $team->github,
            'website'    => $team->website,
            'is_active'  => $team->is_active ? 1 : 0,
            'sort_order' => $team->sort_order,
            'photo'      => $team->photo ? asset('storage/' . $team->photo) : null,
            'initial'    => $team->initial,
            'created_at' => $team->created_at->format('d M Y'),
        ];
    }
}
