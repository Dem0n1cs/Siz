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
        Schema::table('reverse_side_gives', function (Blueprint $table) {
            $table->text('signature_note')->nullable()->after('signature');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reverse_side_gives', function (Blueprint $table) {
            $table->dropColumn('signature_note');
        });
    }
};
