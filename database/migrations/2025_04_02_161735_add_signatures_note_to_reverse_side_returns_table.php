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
        Schema::table('reverse_side_returns', function (Blueprint $table) {
            $table->text('signatures_note')->nullable()->after('signatures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reverse_side_returns', function (Blueprint $table) {
            $table->dropColumn('signatures_note');
        });
    }
};
