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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now()->format('Y-m-d'));
            $table->time('start')->default(now()->format('H:i:s'));
            $table->time('end')->nullable();
            $table->boolean('payment')->default(false);
            $table->integer('count');
            $table->enum('status', ['pending', 'preparing', 'sending', 'delivered'])->default('pending');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');
            $table->foreign('food_id')
                        ->references('id')
                        ->on('foods')
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
        Schema::dropIfExists('orders');
    }
};
