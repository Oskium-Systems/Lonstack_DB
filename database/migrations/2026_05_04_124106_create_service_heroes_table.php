<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('service_heroes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('service_id')->constrained()->cascadeOnDelete();
      $table->string('headline');
      $table->text('description')->nullable();
      $table->string('image')->nullable();
      $table->string('cta_primary_label')->nullable();
      $table->string('cta_primary_url')->nullable();
      $table->string('cta_secondary_label')->nullable();
      $table->string('cta_secondary_url')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('service_heroes');
  }
};
