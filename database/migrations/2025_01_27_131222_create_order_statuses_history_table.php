<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_statuses_history', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'preparing', 'on_the_way', 'delivered', 'cancelled'])->default('pending');
            $table->date('date')->default(Carbon::now());
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('order_id')->index();
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses_history');
    }
};
