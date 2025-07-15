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
        Schema::create('delivery_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_verified')->default(1);
            $table->float('delivery_salary')->nullable();
            $table->decimal('delivery_percentage', 8, 3)->nullable();
            $table->integer('total_deliveries')->default(0);
            $table->time('working_hours_from')->nullable();
            $table->time('working_hours_to')->nullable();
            $table->timestamps();
        });

        Schema::create('city_delivery_company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('delivery_company_id')->constrained('delivery_companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_companies');
        Schema::dropIfExists('city_delivery_company');
    }
};
