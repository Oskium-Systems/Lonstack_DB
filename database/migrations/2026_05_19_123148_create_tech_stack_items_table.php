<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    // Individual tech items inside a group.
    // e.g. PHP, Laravel, MySQL, Docker — each has a name and an icon image.
    Schema::create('tech_stack_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('tech_stack_group_id')
        ->constrained('tech_stack_groups')
        ->cascadeOnDelete();
      $table->string('name');                          // e.g. "Laravel", "MySQL"
      $table->string('icon')->nullable();              // Uploaded icon image path
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('tech_stack_items');
  }
};
