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
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->integer('addressable_id');
            $table->string('addressable_type');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('type');
            $table->string('building_name');
            $table->integer('flat_number');
            $table->integer('floor')->nullable();
            $table->string('street_name')->nullable();
            $table->string('mark')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->unsignedBigInteger('city_id')->index();
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
