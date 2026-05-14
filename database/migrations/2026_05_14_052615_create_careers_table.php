<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('department')->nullable();
            $table->string('location')->default('Remote');
            $table->enum('work_type', ['remote', 'onsite', 'hybrid'])
                  ->default('remote');
            $table->enum('employment_type', [
                'full-time', 'part-time', 'contract', 'internship', 'freelance'
            ])->default('full-time');
            $table->string('experience_level')->nullable();
            $table->string('salary_range')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->longText('responsibilities')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('nice_to_have')->nullable();
            $table->longText('benefits')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
