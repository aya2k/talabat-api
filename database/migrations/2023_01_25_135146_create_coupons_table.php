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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('code');
            $table->date('started_at');
            $table->date('end_at');
            $table->unsignedInteger('order');
            $table->integer('min_order_amount');
            $table->boolean('is_active')->default(1);
            $table->integer('max_num_used');
            $table->integer('num_of_used');
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_value', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
