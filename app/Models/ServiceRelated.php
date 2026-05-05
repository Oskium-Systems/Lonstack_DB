<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRelated extends Model
{
  protected $table = 'service_related';

  protected $fillable = [
    'service_id',
    'related_service_id',
    'section_heading',
    'section_subtitle',
    'sort_order',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }

  public function relatedService(): BelongsTo
  {
    return $this->belongsTo(Service::class, 'related_service_id');
  }
}
