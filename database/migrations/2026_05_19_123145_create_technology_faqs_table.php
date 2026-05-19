<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_faqs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();   // e.g. "Frequently Asked Questions"
      $table->string('section_subtitle')->nullable();
      $table->string('question');                      // FAQ question
      $table->text('answer');                          // FAQ answer (Quill HTML)
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_faqs');
  }
};
