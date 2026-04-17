<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::current();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Company Info
            'company_name'    => ['required', 'string', 'max:255'],
            'company_email'   => ['nullable', 'email', 'max:255'],
            'support_email'   => ['nullable', 'email', 'max:255'],
            'company_phone'   => ['nullable', 'string', 'max:20'],
            'company_address' => ['nullable', 'string', 'max:500'],

            // SEO
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords'    => ['nullable', 'string', 'max:500'],
            'meta_author'      => ['nullable', 'string', 'max:255'],

            // Social Media
            'site_fb'        => ['nullable', 'url', 'max:255'],
            'site_instagram' => ['nullable', 'url', 'max:255'],
            'site_twitter'   => ['nullable', 'url', 'max:255'],
            'site_linkedin'  => ['nullable', 'url', 'max:255'],
            'site_youtube'   => ['nullable', 'url', 'max:255'],
            'site_tiktok'    => ['nullable', 'url', 'max:255'],
            'site_github'    => ['nullable', 'url', 'max:255'],
            'site_whatsapp'  => ['nullable', 'string', 'max:20'],

            // Maintenance
            'maintenance_mode'    => ['nullable', 'boolean'],
            'maintenance_message' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['maintenance_mode'] = $request->boolean('maintenance_mode');

        $settings = Setting::current();
        $settings->fill($validated)->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
