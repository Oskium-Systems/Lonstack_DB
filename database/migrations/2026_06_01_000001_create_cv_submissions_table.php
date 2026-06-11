<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('cv_submissions', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->string('email', 150);
      $table->string('phone', 40)->nullable();
      $table->string('position', 200)->nullable();
      $table->text('message')->nullable();
      $table->string('cv_path', 500);
      $table->string('cv_original_name', 255);
      $table->string('cv_mime', 100)->nullable();
      $table->unsignedBigInteger('cv_size')->nullable();
      $table->enum('status', ['new', 'reviewed', 'shortlisted', 'rejected'])->default('new');
      $table->text('admin_notes')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('cv_submissions');
  }
};
