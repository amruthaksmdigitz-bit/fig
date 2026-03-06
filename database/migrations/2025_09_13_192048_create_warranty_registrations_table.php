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
        Schema::create('warranty_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('serial_number');
            $table->string('phone_number')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('address')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('customer_name');
            $table->string('dealer_name');
            $table->string('dealer_phone_number')->nullable();
            $table->string('area')->nullable();
            $table->string('body_parts')->nullable();
            $table->string('email');
            $table->timestamps();

            // optional foreign key (if you have a products table)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_registrations');
    }
};