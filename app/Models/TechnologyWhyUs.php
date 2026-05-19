<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyWhyUs extends Model
{
  protected $table = 'technology_why_us';

  protected $fillable = [
    'technology_id',
    'section_heading',   // e.g. "Why Choose Us"
    'section_subtitle',
    'title',
    'description',       // Quill HTML
    'sort_order',
  ];

  /** The technology this "why us" item belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
