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
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('shopping_carts_id')->constrained('shopping_carts')->onDelete('cascade');
            $table->foreignId('product_varient_id')->constrained('product_varients')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('price', 12, 2);
            $table->boolean('saved_for_later')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
