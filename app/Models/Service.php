<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Service extends Model
{
  protected $fillable = [
    'service_category_id',
    'name',
    'slug',
    'short_description',
    'badge',
    'sort_order',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  /**
   * Use slug as the route model binding key.
   */
  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  protected static function booted(): void
  {
    static::creating(function (self $model) {
      $model->slug ??= Str::slug($model->name);
    });
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(ServiceCategory::class, 'service_category_id');
  }

  public function hero(): HasOne
  {
    return $this->hasOne(ServiceHero::class);
  }

  public function benefits(): HasMany
  {
    return $this->hasMany(ServiceBenefit::class)->orderBy('sort_order');
  }

  public function talkToUs(): HasOne
  {
    return $this->hasOne(ServiceTalkToUs::class);
  }

  public function processSteps(): HasMany
  {
    return $this->hasMany(ServiceProcessStep::class)->orderBy('sort_order');
  }

  public function techGroups(): HasMany
  {
    return $this->hasMany(ServiceTechGroup::class)->orderBy('sort_order');
  }

  public function testimonials(): HasMany
  {
    return $this->hasMany(ServiceTestimonial::class)->orderBy('sort_order');
  }

  public function faqs(): HasMany
  {
    return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
  }

  public function relatedServices(): HasMany
  {
    return $this->hasMany(ServiceRelated::class)->orderBy('sort_order');
  }

  public function portfolios(): HasMany
  {
    return $this->hasMany(Portfolio::class)->orderBy('sort_order');
  }

  public function scopeActive($query): void
  {
    $query->where('is_active', true)->orderBy('sort_order');
  }

  public function getBadgeLabelAttribute(): ?string
  {
    return match ($this->badge) {
      'hot'     => 'HOT 🔥',
      'new'     => 'NEW',
      default   => null,
    };
  }
}
