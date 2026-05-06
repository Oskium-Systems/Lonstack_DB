<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceHero extends Model
{
  protected $fillable = [
    'service_id',
    'headline',
    'description',
    'image',
    'cta_primary_label',
    'cta_primary_url',
    'cta_secondary_label',
    'cta_secondary_url',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }
}
