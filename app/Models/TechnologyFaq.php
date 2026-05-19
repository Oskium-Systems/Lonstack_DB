<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyFaq extends Model
{
  protected $fillable = [
    'technology_id',
    'section_heading',   // e.g. "Frequently Asked Questions"
    'section_subtitle',
    'question',
    'answer',            // Quill HTML
    'sort_order',
  ];

  /** The technology this FAQ belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
