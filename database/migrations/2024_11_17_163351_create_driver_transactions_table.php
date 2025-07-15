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
        Schema::create('driver_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->unsignedBigInteger('driver_id')->nullable()->index();
            $table->unsignedBigInteger('order_id')->nullable()->index();
            $table->decimal('amount', 20, 4);
            $table->date('collected_at');
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('driver_transactions');
    }
};
