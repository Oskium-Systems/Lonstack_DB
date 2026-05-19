<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_heroes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('headline');                      // Main hero heading
      $table->text('description')->nullable();         // Hero subtext (Quill HTML)
      $table->string('image')->nullable();             // Hero background/feature image
      $table->string('cta_label')->nullable();         // CTA button text
      $table->string('cta_url')->nullable();           // CTA button URL
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_heroes');
  }
};
