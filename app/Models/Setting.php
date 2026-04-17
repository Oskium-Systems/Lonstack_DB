<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'company_email',
        'support_email',
        'company_phone',
        'company_address',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'site_fb',
        'site_instagram',
        'site_twitter',
        'site_linkedin',
        'site_youtube',
        'site_tiktok',
        'site_github',
        'site_whatsapp',
        'maintenance_mode',
        'maintenance_message',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];



    public static function current(): self
    {
        $id = Cache::rememberForever('site_settings_id', function () {
            return self::query()->value('id') ?? self::create([
                'company_name'       => 'Lonstack Software',
                'meta_title'         => 'Lonstack Software - IT Solutions & Software Development',
                'meta_description'   => 'Lonstack Software delivers cutting-edge software development, blockchain, AI, and cloud solutions for businesses worldwide.',
                'meta_keywords'      => 'software development, IT company, blockchain, AI solutions, web development, Lonstack',
                'meta_author'        => 'Lonstack Software',
                'maintenance_mode'   => false,
                'maintenance_message' => 'We are currently performing scheduled maintenance. We will be back shortly.',
            ])->id;
        });

        return self::findOrFail($id);
    }

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('site_settings_id'); // ✅ match new key
        });
    }
}
