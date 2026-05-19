<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_benefits', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();   // e.g. "What Are The Benefits of Laravel"
      $table->string('section_subtitle')->nullable();
      $table->string('title');                         // Benefit title
      $table->text('description')->nullable();         // Benefit body (Quill HTML)
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_benefits');
  }
};
