<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyBenefit extends Model
{
  protected $fillable = [
    'technology_id',
    'section_heading',   // e.g. "What Are The Benefits of Laravel"
    'section_subtitle',
    'title',
    'description',       // Quill HTML
    'sort_order',
  ];

  /** The technology this benefit belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
