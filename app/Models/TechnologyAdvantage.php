<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyAdvantage extends Model
{
  protected $fillable = [
    'technology_id',
    'section_heading',   // Shown once above the list (first item only)
    'section_subtitle',
    'title',
    'description',       // Quill HTML
    'sort_order',
  ];

  /** The technology this advantage belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
