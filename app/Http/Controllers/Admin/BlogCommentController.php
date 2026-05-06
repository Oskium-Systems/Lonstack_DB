<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCommentController extends Controller
{
    private const PER_PAGE = 10;

    public function index()
    {
        return view('admin.blog.blogcomments');
    }

    public function search(Request $request)
    {
        $q      = trim($request->get('q', ''));
        $status = $request->get('status', '');
        $page   = max(1, (int) $request->get('page', 1));

        // Check if parent_id column exists (migration may not have run yet)
        $hasParentId = \Illuminate\Support\Facades\Schema::hasColumn('blog_comments', 'parent_id');

        $query = BlogComment::with(array_filter([
            'blog',
            'user',
            $hasParentId ? 'parent' : null,
        ]))->latest();

        if ($q !== '') {
            $query->where(function ($q2) use ($q) {
                $q2->where('comment', 'like', "%{$q}%")
                   ->orWhere('name', 'like', "%{$q}%")
                   ->orWhereHas('blog', fn($b) => $b->where('title', 'like', "%{$q}%"));
            });
        }

       if (!empty($status) && in_array($status, ['pending', 'published', 'unpublished'])) {
    $query->where('status', $status);
}

        $paginated = $query->paginate(self::PER_PAGE, ['*'], 'page', $page);

        return response()->json([
            'comments'     => $paginated->map(fn($c) => $this->commentData($c, $hasParentId))->values(),
            'total'        => $paginated->total(),
            'per_page'     => $paginated->perPage(),
            'current_page' => $paginated->currentPage(),
            'last_page'    => $paginated->lastPage(),
        ]);
    }

    public function updateStatus(Request $request, BlogComment $blogComment)
    {
        $request->validate(['status' => 'required|in:pending,published,unpublished']);
        $blogComment->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Comment status updated.',
        ]);
    }

    public function destroy(BlogComment $blogComment)
    {
        $blogComment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.',
        ]);
    }

    private function commentData(BlogComment $c, bool $hasParentId = true): array
    {
        return [
            'id'             => $c->id,
            'comment'        => $c->comment,
            'blog'           => $c->blog?->title ?? '—',
            'author'         => $c->author_name,
            'rating'         => $c->rating,
            'status'         => $c->status,
            'is_reply'       => $hasParentId && $c->parent_id !== null,
            'parent_excerpt' => ($hasParentId && $c->parent)
                ? Str::limit($c->parent->comment, 40)
                : null,
            'created_at'     => $c->created_at->format('d M Y'),
        ];
    }
}
