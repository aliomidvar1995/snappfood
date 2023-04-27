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
        Schema::create('offs', function (Blueprint $table) {
            $table->id();
            $table->integer('off');
            $table->unsignedBigInteger('food_categories_id');
            $table->timestamps();
            $table->foreign('food_categories_id')
                        ->references('id')
                        ->on('food_categories')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offs');
    }
};
