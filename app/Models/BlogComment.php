<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'blog_id', 'parent_id', 'user_id', 'name', 'email', 'comment', 'rating', 'status',
    ];

    // ── Relationships ─────────────────────────────────────────────

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** The comment this reply belongs to (null for top-level comments) */
    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    /** Direct replies to this comment */
    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')->latest();
    }

    /** Published replies only */
    public function publishedReplies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')
                    ->where('status', 'published')
                    ->latest();
    }

    // ── Accessors ─────────────────────────────────────────────────

    public function getAuthorNameAttribute(): string
    {
        return $this->user?->name ?? $this->name ?? 'Anonymous';
    }

    public function getIsReplyAttribute(): bool
    {
        return $this->parent_id !== null;
    }
}
