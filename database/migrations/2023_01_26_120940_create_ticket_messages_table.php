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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('ticket_id');
            $table->text('content')->nullable(); 
            $table->bigInteger('seconds')->nullable(); 
            $table->string('image')->nullable(); 
            $table->string('recording')->nullable(); 
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_messages');
    }
};
