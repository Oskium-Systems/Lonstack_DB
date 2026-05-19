<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technologies', function (Blueprint $table) {
      $table->id();
      $table->string('name');                          // e.g. "Laravel", "Node.js"
      $table->string('slug')->unique();                // URL key: /technologies/laravel
      $table->string('icon')->nullable();              // Tabler/custom icon class
      $table->string('meta_title')->nullable();        // SEO title
      $table->text('meta_description')->nullable();    // SEO description
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technologies');
  }
};
