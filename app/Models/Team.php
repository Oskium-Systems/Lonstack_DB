<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'role',
        'department',
        'photo',
        'bio',
        'experience',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'github',
        'website',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Scopes ────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ── Accessors ─────────────────────────────────────────────
    public function getInitialAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    // ── Auto-generate slug ────────────────────────────────────
    protected static function booted(): void
    {
        static::creating(function (Team $team) {
            if (empty($team->slug)) {
                $team->slug = static::uniqueSlug($team->name);
            }
        });

        static::updating(function (Team $team) {
            if ($team->isDirty('name') && empty($team->getOriginal('slug'))) {
                $team->slug = static::uniqueSlug($team->name);
            }
        });
    }

    private static function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }
}
