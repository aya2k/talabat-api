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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('short_desc_ar')->nullable();
            $table->string('short_desc_en')->nullable();
            $table->enum('type', ['food', 'clothes', 'medicine', 'market'])->default('food');
            // $table->string('type');
            $table->time('working_hours_from')->nullable();
            $table->time('working_hours_to')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_verified')->default(1);
            $table->integer('min_order_amount')->nullable();
            $table->float('delivery_fee')->nullable();
            $table->integer('estimated_delivery_time')->nullable();
            $table->float('estimate_price')->nullable();

            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->unsignedBigInteger('category_id')->index()->nullable();

            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('providers')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
