<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('technologies', function (Blueprint $table) {
      // Short description shown in the nav mega menu under the tech name
      $table->string('short_description')->nullable()->after('icon');
    });
  }

  public function down(): void
  {
    Schema::table('technologies', function (Blueprint $table) {
      $table->dropColumn('short_description');
    });
  }
};
