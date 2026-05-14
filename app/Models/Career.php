<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'work_type',
        'employment_type',
        'experience_level',
        'salary_range',
        'excerpt',
        'description',
        'responsibilities',
        'requirements',
        'nice_to_have',
        'benefits',
        'tags',
        'is_active',
        'is_featured',
        'sort_order',
        'deadline',
    ];

    protected $casts = [
        'tags'        => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'deadline'    => 'date',
    ];

    // ── Scopes ────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ── Accessors ─────────────────────────────────────────────
    public function getEmploymentLabelAttribute(): string
    {
        return match ($this->employment_type) {
            'full-time'  => 'Full-Time',
            'part-time'  => 'Part-Time',
            'contract'   => 'Contract',
            'internship' => 'Internship',
            'freelance'  => 'Freelance',
            default      => ucfirst($this->employment_type),
        };
    }

    public function getWorkTypeLabelAttribute(): string
    {
        return match ($this->work_type) {
            'remote'  => 'Remote',
            'onsite'  => 'On-site',
            'hybrid'  => 'Hybrid',
            default   => ucfirst($this->work_type),
        };
    }

    // ── Auto-generate slug ────────────────────────────────────
    protected static function booted(): void
    {
        static::creating(function (Career $career) {
            if (empty($career->slug)) {
                $career->slug = static::uniqueSlug($career->title);
            }
        });

        static::updating(function (Career $career) {
            if ($career->isDirty('title') && empty($career->getOriginal('slug'))) {
                $career->slug = static::uniqueSlug($career->title);
            }
        });
    }

    private static function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }
}
