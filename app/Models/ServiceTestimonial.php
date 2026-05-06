<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTestimonial extends Model
{
  protected $fillable = [
    'service_id',
    'section_heading',
    'section_subtitle',
    'quote',
    'client_name',
    'client_role',
    'rating',
    'sort_order',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }
}
