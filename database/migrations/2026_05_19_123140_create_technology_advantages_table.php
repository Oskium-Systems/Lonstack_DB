<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('technology_advantages', function (Blueprint $table) {
      $table->id();
      $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();   // e.g. "Advantages"
      $table->string('section_subtitle')->nullable();  // Optional section subheading
      $table->string('title');                         // Advantage title
      $table->text('description')->nullable();         // Advantage body (Quill HTML)
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('technology_advantages');
  }
};
