<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_why_us', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();   // e.g. "Why Choose Us"
      $table->string('section_subtitle')->nullable();
      $table->string('title');                         // Reason title
      $table->text('description')->nullable();         // Reason body (Quill HTML)
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_why_us');
  }
};
