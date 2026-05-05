<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTalkToUs extends Model
{
  protected $table = 'service_talk_to_us';

  protected $fillable = [
    'service_id',
    'person_name',
    'person_role',
    'person_avatar',
    'headline',
    'subtext',
    'cta_label',
    'cta_url',
  ];

  public function service(): BelongsTo
  {
    return $this->belongsTo(Service::class);
  }
}
