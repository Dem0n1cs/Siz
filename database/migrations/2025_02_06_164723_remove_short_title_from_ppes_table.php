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
        Schema::table('ppes', function (Blueprint $table) {
            $table->dropColumn('short_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppes', function (Blueprint $table) {
            $table->string('short_title')->after('title'); // Укажите правильную позицию, если это важно
        });
    }
};
