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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->integer('price');
            $table->integer('discounted_price');
            $table->integer('food_party_price');
            $table->text('material')->nullable();
            $table->unsignedBigInteger('food_categories_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->timestamps();
            $table->foreign('food_categories_id')
                        ->references('id')
                        ->on('food_categories')
                        ->onDelete('cascade');
            $table->foreign('restaurant_id')
                        ->references('id')
                        ->on('restaurants')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
