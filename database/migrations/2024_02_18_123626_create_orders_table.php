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
            $table->string('uid')->unique();
            $table->unsignedBigInteger('driver_id')->nullable()->index();
            $table->unsignedBigInteger('provider_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('shopping_carts_id')->index();
            $table->unsignedBigInteger('coupon_id')->nullable()->index();
            $table->dateTime('order_time')->useCurrent();
            $table->dateTime('delivery_time');
            $table->float('sub_total')->default(0);
            $table->float('delivery_fee')->default(0);
            $table->float('tax_amount')->default(0);
            $table->float('total_price')->default(0);
            $table->text('special_instructions')->nullable();
            $table->enum('payment_type', ['cash', 'visa'])->default('cash');
            $table->enum('status', ['pending', 'cancelled', 'in_progress', 'completed', 'reported', 'schedule'])->default('pending');
            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('cascade');

            $table->foreign('coupon_id')
                ->references('id')
                ->on('coupons')
                ->onDelete('cascade');

            $table->foreign('shopping_carts_id')
                ->references('id')
                ->on('shopping_carts')
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
