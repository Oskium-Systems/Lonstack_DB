<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechStackItem extends Model
{
  protected $fillable = [
    'tech_stack_group_id',
    'name',         // e.g. "Laravel", "MySQL", "Docker"
    'icon',         // Uploaded icon image path (storage/app/public/tech-stack/)
    'sort_order',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  /** The group this item belongs to */
  public function group(): BelongsTo
  {
    return $this->belongsTo(TechStackGroup::class, 'tech_stack_group_id');
  }
}
