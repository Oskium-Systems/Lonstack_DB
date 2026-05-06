<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonial.manageTestimonial', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'position'   => 'nullable|string|max:100',
            'company'    => 'nullable|string|max:100',
            'content'    => 'required|string|max:1000',
            'rating'     => 'required|integer|min:1|max:5',
            'avatar'     => 'nullable|image|max:1024',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial = Testimonial::create([
            'name'       => $request->name,
            'position'   => $request->position,
            'company'    => $request->company,
            'content'    => $request->content,
            'rating'     => $request->rating,
            'avatar'     => $avatarPath,
            'status'     => $request->boolean('status', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'success'     => true,
            'message'     => 'Testimonial added successfully.',
            'testimonial' => $this->testimonialData($testimonial),
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'position'   => 'nullable|string|max:100',
            'company'    => 'nullable|string|max:100',
            'content'    => 'required|string|max:1000',
            'rating'     => 'required|integer|min:1|max:5',
            'avatar'     => 'nullable|image|max:1024',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $avatarPath = $testimonial->avatar;
        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $avatarPath = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update([
            'name'       => $request->name,
            'position'   => $request->position,
            'company'    => $request->company,
            'content'    => $request->content,
            'rating'     => $request->rating,
            'avatar'     => $avatarPath,
            'status'     => $request->boolean('status', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'success'     => true,
            'message'     => 'Testimonial updated successfully.',
            'testimonial' => $this->testimonialData($testimonial),
        ]);
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully.',
        ]);
    }

    public function toggleStatus(Request $request, Testimonial $testimonial)
    {
        $testimonial->update(['status' => !$testimonial->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated.',
            'status'  => $testimonial->status,
        ]);
    }

    private function testimonialData(Testimonial $t): array
    {
        return [
            'id'         => $t->id,
            'name'       => $t->name,
            'position'   => $t->position,
            'company'    => $t->company,
            'content'    => $t->content,
            'rating'     => $t->rating,
            'status'     => $t->status ? 1 : 0,
            'sort_order' => $t->sort_order,
            'avatar'     => $t->avatar ? asset('storage/' . $t->avatar) : null,
            'initial'    => $t->initial,
            'created_at' => $t->created_at->format('d M Y'),
        ];
    }
}
