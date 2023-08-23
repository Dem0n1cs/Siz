<?php

use App\Models\PersonalCard;
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
        Schema::create('front_sides', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonalCard::class)->constrained();
            $table->string('gender');
            $table->string('growth');
            $table->string('clothing_size');
            $table->string('shoe_size')->nullable();
            $table->string('glove_size')->nullable();
            $table->string('corrective_glasses')->nullable();
            $table->string('scanned_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_sides');
    }
};
