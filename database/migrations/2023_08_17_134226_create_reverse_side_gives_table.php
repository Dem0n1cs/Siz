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
        Schema::create('reverse_side_gives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonalCard::class)->constrained();
            $table->date('date')->nullable();
            $table->string('quantity')->nullable();
            $table->unsignedTinyInteger('percentage_wear')->nullable();
            $table->decimal('cost', total: 6, places: 2,unsigned: true)->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reverse_side_gives');
    }
};
