<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->index()->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('payment_method_id')->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->decimal('total_price', 20, 4)->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->date('payment_at');
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
