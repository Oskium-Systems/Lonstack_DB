<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('service_tech_tags', function (Blueprint $table) {
      $table->id();
      $table->foreignId('service_tech_group_id')
        ->constrained('service_tech_groups')
        ->cascadeOnDelete();
      $table->string('name');
      $table->boolean('is_featured')->default(false);
      $table->unsignedSmallInteger('sort_order')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('service_tech_tags');
  }
};
