<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'company',
        'avatar',
        'content',
        'rating',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'rating' => 'integer',
    ];

    /**
     * Scope: only visible testimonials, ordered by sort_order then latest.
     */
    public function scopeVisible($query)
    {
        return $query->where('status', true)
                     ->orderBy('sort_order')
                     ->latest();
    }

    /**
     * Returns the first letter of the name for the avatar initial fallback.
     */
    public function getInitialAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }
}
