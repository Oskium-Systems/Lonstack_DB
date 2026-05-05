<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceTechGroup extends Model
{
  protected $fillable = [
    'service_id',
    'section_heading',
    'section_subtitle',
    'group_name',
    'sort_order',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }

  public function tags(): HasMany
  {
    return $this->hasMany(ServiceTechTag::class)->orderBy('sort_order');
  }
}
