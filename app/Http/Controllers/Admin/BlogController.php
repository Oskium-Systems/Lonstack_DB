<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs      = Blog::with('category')->latest()->get();
        $categories = BlogCategory::where('status', true)->get();
        return view('admin.blog.allblogs', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        $blog->load('category', 'author', 'comments');
        return view('admin.blog.blogdetails', compact('blog'));
    }

    public function search(Request $request)
    {
        $q      = $request->get('q', '');
        $status = $request->get('status', '');

        $query = Blog::with('category')->latest();

        if ($q) {
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('tags', 'like', "%{$q}%");
            });
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        return response()->json([
            'blogs' => $query->get()->map(fn($b) => $this->blogData($b)),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:blog_categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'category_id'      => $request->category_id,
            'author_id'        => Auth::id(),
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'excerpt'          => $request->excerpt,
            'description'      => $request->description,
            'image'            => $imagePath,
            'tags'             => $request->tags,
            'status'           => $request->has('status') ? 1 : 0,
            'featured'         => $request->has('featured') ? 1 : 0,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'published_at'     => now(),
        ]);

        $blog->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully.',
            'blog'    => $this->blogData($blog),
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'nullable|exists:blog_categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            if ($blog->image) Storage::disk('public')->delete($blog->image);
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'excerpt'          => $request->excerpt,
            'description'      => $request->description,
            'image'            => $imagePath,
            'tags'             => $request->tags,
            'status'           => $request->has('status') ? 1 : 0,
            'featured'         => $request->has('featured') ? 1 : 0,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        $blog->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully.',
            'blog'    => $this->blogData($blog),
        ]);
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) Storage::disk('public')->delete($blog->image);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.',
        ]);
    }

    private function blogData(Blog $blog): array
    {
        return [
            'id'               => $blog->id,
            'title'            => $blog->title,
            'category'         => $blog->category->name ?? 'Uncategorized',
            'category_id'      => $blog->category_id,
            'excerpt'          => $blog->excerpt,
            'description'      => $blog->description,
            'tags'             => $blog->tags,
            'status'           => $blog->status ? 1 : 0,
            'featured'         => $blog->featured ? 1 : 0,
            'meta_title'       => $blog->meta_title,
            'meta_description' => $blog->meta_description,
            'image'            => $blog->image ? asset('storage/' . $blog->image) : asset('dashboard_assets/img/bg/hero.jpg'),
            'created_at'       => $blog->created_at->format('d M Y'),
        ];
    }
}
