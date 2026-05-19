<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Technology extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'icon',
    'short_description',  // Shown in nav mega menu under the tech name
    'meta_title',
    'meta_description',
    'sort_order',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  /**
   * Auto-generate slug from name on create if not provided.
   */
  protected static function booted(): void
  {
    static::creating(function (self $model) {
      $model->slug ??= Str::slug($model->name);
    });
  }

  /**
   * Use slug as the route model binding key.
   * Enables /technologies/{slug} URLs.
   */
  public function getRouteKeyName(): string
  {
    return 'slug';
  }

    // ── Relationships ──────────────────────────────────────

  /** One hero section per technology */
  public function hero(): HasOne
  {
    return $this->hasOne(TechnologyHero::class);
  }

  /** Numbered advantages list */
  public function advantages(): HasMany
  {
    return $this->hasMany(TechnologyAdvantage::class)->orderBy('sort_order');
  }

  /** Benefits section items */
  public function benefits(): HasMany
  {
    return $this->hasMany(TechnologyBenefit::class)->orderBy('sort_order');
  }

  /** Why Choose Us section items */
  public function whyUs(): HasMany
  {
    return $this->hasMany(TechnologyWhyUs::class)->orderBy('sort_order');
  }

  /** Development process steps */
  public function processes(): HasMany
  {
    return $this->hasMany(TechnologyProcess::class)->orderBy('sort_order');
  }

  /** FAQ items */
  public function faqs(): HasMany
  {
    return $this->hasMany(TechnologyFaq::class)->orderBy('sort_order');
  }

    // ── Scopes ─────────────────────────────────────────────

  /** Only active technologies, ordered by sort_order */
  public function scopeActive($query): void
  {
    $query->where('is_active', true)->orderBy('sort_order');
  }
}
