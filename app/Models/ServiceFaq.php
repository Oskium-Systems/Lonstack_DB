<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceFaq extends Model
{
  protected $fillable = [
    'service_id',
    'section_heading',
    'section_subtitle',
    'question',
    'answer',
    'sort_order',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }
}
