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
        Schema::create('driver_wallets', function (Blueprint $table) {
            $table->id();
            $table->float('available_balance')->default(0);
            $table->float('pending_balance')->default(0);
            $table->float('profits')->default(0);
            $table->unsignedBigInteger('driver_id')->index();
            $table->timestamps();


            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_wallets');
    }
};
