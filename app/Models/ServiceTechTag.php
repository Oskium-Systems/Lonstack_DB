<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTechTag extends Model
{
  protected $fillable = [
    'service_tech_group_id',
    'name',
    'is_featured',
    'sort_order',
  ];

  protected $casts = [
    'is_featured' => 'boolean',
  ];

  public function group(): BelongsTo
  {
    return $this->belongsTo(ServiceTechGroup::class, 'service_tech_group_id');
  }
}
