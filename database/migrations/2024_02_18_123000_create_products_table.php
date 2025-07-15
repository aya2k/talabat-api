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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            //  $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar');
            $table->string('desc_en');
            // $table->string('image');
            $table->double('base_price', 8, 2);
            $table->integer('amount');
            $table->boolean('is_trendy')->default(false);  //Best Seller
            $table->boolean('is_available')->default(true);
            $table->double('discount', 8, 2)->default(0)->nullable();
            // $table->float('rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
