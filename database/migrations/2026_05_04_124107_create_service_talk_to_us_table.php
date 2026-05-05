<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('service_talk_to_us', function (Blueprint $table) {
      $table->id();
      $table->foreignId('service_id')->constrained()->cascadeOnDelete();
      $table->string('person_name')->nullable();
      $table->string('person_role')->nullable();
      $table->string('person_avatar')->nullable();
      $table->string('headline');
      $table->string('subtext')->nullable();
      $table->string('cta_label');
      $table->string('cta_url');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('service_talk_to_us');
  }
};
