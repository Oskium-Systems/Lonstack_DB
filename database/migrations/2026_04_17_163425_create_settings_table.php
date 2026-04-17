<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Company Info
            $table->string('company_name')->default('Lonstack Software');
            $table->string('company_email')->nullable();
            $table->string('support_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('company_address')->nullable();

            // SEO
            $table->string('meta_title')->default('Lonstack Software - IT Solutions & Software Development');
            // $table->text('meta_description')->default('Lonstack Software delivers cutting-edge software development, blockchain, AI, and cloud solutions for businesses worldwide.');
            // $table->text('meta_keywords')->default('software development, IT company, blockchain development, AI solutions, web development, mobile app development, Lonstack');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_author')->default('Lonstack Software');




            // Social Media
            $table->string('site_fb')->nullable();
            $table->string('site_instagram')->nullable();
            $table->string('site_twitter')->nullable();
            $table->string('site_linkedin')->nullable();
            $table->string('site_youtube')->nullable();
            $table->string('site_tiktok')->nullable();
            $table->string('site_github')->nullable();
            $table->string('site_whatsapp')->nullable();

            // Maintenance
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_message')->nullable();
            // $table->text('maintenance_message')->nullable()->default('We are currently performing scheduled maintenance. We will be back shortly.');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
