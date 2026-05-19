<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechStackGroup extends Model
{
  protected $fillable = [
    'name',         // e.g. "Frameworks & Languages", "Database", "DevOps & Cloud"
    'sort_order',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  /**
   * All tech items inside this group.
   * Ordered by sort_order for consistent display.
   */
  public function items(): HasMany
  {
    return $this->hasMany(TechStackItem::class)->orderBy('sort_order');
  }

  /**
   * Only active items in this group.
   */
  public function activeItems(): HasMany
  {
    return $this->hasMany(TechStackItem::class)
      ->where('is_active', true)
      ->orderBy('sort_order');
  }

  /** Only active groups, ordered */
  public function scopeActive($query): void
  {
    $query->where('is_active', true)->orderBy('sort_order');
  }
}
