<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.blog.managecategories', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $categories = BlogCategory::where('name', 'like', "%{$query}%")
            ->orWhere('slug', 'like', "%{$query}%")
            ->latest()
            ->get();

        return response()->json([
            'found' => $categories->isNotEmpty(),
            'categories' => $categories->map(fn($c) => [
                'id'         => $c->id,
                'name'       => $c->name,
                'slug'       => $c->slug,
                'status'     => $c->status,
                'created_at' => $c->created_at->format('d M Y'),
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);

        BlogCategory::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return back()->with('success', 'Category added successfully.');
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
        ]);

        $blogCategory->update([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
