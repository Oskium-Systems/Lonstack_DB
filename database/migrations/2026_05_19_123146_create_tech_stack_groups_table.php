<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    // Global "Technologies We Use" groups — NOT per technology.
    // e.g. "Frameworks & Languages", "Database", "DevOps & Cloud"
    // Shared across all technology pages and any other page that needs it.
    Schema::create('tech_stack_groups', function (Blueprint $table) {
      $table->id();
      $table->string('name');                          // Group label
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('tech_stack_groups');
  }
};
