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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('desc_ar');
            $table->string('desc_en');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
            // $table->text('image');
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
        Schema::dropIfExists('menus');
    }
};
