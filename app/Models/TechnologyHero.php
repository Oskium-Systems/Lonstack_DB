<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyHero extends Model
{
  protected $fillable = [
    'technology_id',
    'headline',
    'description',  // Quill HTML
    'image',        // Stored in storage/app/public/technologies/hero
    'cta_label',
    'cta_url',
  ];

  /** The technology this hero belongs to */
  public function technology(): BelongsTo
  {
    return $this->belongsTo(Technology::class);
  }
}
