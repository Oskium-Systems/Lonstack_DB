<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('service_testimonials', function (Blueprint $table) {
      $table->id();
      $table->foreignId('service_id')->constrained()->cascadeOnDelete();
      $table->string('section_heading')->nullable();
      $table->string('section_subtitle')->nullable();
      $table->text('quote');
      $table->string('client_name');
      $table->string('client_role')->nullable();
      $table->unsignedTinyInteger('rating')->default(5);
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('service_testimonials');
  }
};
