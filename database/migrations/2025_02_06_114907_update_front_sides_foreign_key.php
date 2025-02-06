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
        Schema::table('front_sides', function (Blueprint $table) {
                $table->dropForeign(['personal_card_id']);
        });

            Schema::table('front_sides', function (Blueprint $table) {
                $table->foreign('personal_card_id')
                    ->references('id')
                    ->on('personal_cards')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('front_sides', function (Blueprint $table) {
                $table->dropForeign(['personal_card_id']);
            });

            Schema::table('front_sides', function (Blueprint $table) {
                $table->foreign('personal_card_id')
                    ->references('id')
                    ->on('personal_cards')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            });
    }
};
