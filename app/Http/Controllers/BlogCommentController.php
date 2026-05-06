<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    /**
     * Store a new top-level comment or a reply from a guest visitor.
     */
    public function store(Request $request, string $slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', true)->firstOrFail();

        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'comment'   => 'required|string|max:2000',
            'parent_id' => 'nullable|integer|exists:blog_comments,id',
        ]);

        // If replying, make sure the parent belongs to this blog
        if (!empty($validated['parent_id'])) {
            $parent = BlogComment::where('id', $validated['parent_id'])
                                 ->where('blog_id', $blog->id)
                                 ->whereNull('parent_id') // only allow one level of nesting
                                 ->first();

            if (!$parent) {
                return back()->withErrors(['comment' => 'Invalid reply target.'])->withInput();
            }
        }

        BlogComment::create([
            'blog_id'   => $blog->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'user_id'   => auth()->id(),
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'comment'   => $validated['comment'],
            'status'    => 'pending',
        ]);

        return back()
            ->with('comment_success', 'Your comment has been submitted and is awaiting moderation. Thank you!')
            ->withFragment('comments');
    }
}
