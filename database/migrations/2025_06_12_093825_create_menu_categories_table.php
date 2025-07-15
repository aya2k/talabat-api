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
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable()->index();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar');
            $table->string('desc_en');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->nullable();
            $table->timestamps();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_categories');
    }
};
