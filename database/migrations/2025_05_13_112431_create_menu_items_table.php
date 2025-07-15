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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('menus_id')->constrained('menus')->onDelete('cascade');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar');
            $table->string('desc_en');
            // $table->string('image');
            $table->double('inital_price', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
