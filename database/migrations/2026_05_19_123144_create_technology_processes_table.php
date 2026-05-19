<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_processes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();   // e.g. "Our Laravel Development Process"
      $table->string('section_subtitle')->nullable();
      $table->string('title');                         // Step title
      $table->text('description')->nullable();         // Step body (Quill HTML)
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_processes');
  }
};
