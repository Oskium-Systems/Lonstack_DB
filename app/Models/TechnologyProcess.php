<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyProcess extends Model
{
  protected $fillable = [
    'technology_id',
    'section_heading',   // e.g. "Our Laravel Development Process"
    'section_subtitle',
    'title',
    'description',       // Quill HTML
    'sort_order',
  ];

  /** The technology this process step belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
