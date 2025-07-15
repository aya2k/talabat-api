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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //  $table->string('image')->nullable();
            $table->string('phone');
            $table->string('password')->nullable();
            $table->char('otp', 6)->nullable();
            $table->datetime('otp_expires_at')->nullable();
            $table->date('birth_date');
            // $table->float('avg_rate')->default('4');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->timestamp('last_online');
            $table->string('license_number');
            $table->string('current_location_lat')->nullable();
            $table->string('current_location_lng')->nullable();



            $table->enum('type', ['motobike', 'bike'])->nullable();
            $table->boolean('is_available')->default(1);
            $table->boolean('is_active')->default(1);


            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_version')->nullable();


            $table->string('national_id_number')->unique()->nullable();
            $table->string('national_id_front_image')->nullable();
            $table->string('national_id_back_image')->nullable();
            $table->enum('national_id_status', ['pending', 'approved', 'refused', 'not_completed'])->default('not_completed');
            $table->string('creminal_image')->nullable();
            $table->enum('creminal_status', ['pending', 'approved', 'refused', 'not_completed'])->default('not_completed');
            $table->boolean('has_complete_data')->default(0);
            $table->boolean('is_verify_documents')->default(0);

            $table->unsignedBigInteger('city_id')->index()->nullable();
            $table->unsignedBigInteger('delivery_company_id')->index()->nullable();

            $table->timestamps();


            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->foreign('delivery_company_id')
                ->references('id')
                ->on('delivery_companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
