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
        Schema::create('feed_images', function (Blueprint $table) {

            $table->id();

            // feed post id
            $table->unsignedBigInteger('feed_id');

            // image path
            $table->string('image');

            $table->timestamps();

            // foreign key
            $table->foreign('feed_id')
                  ->references('id')
                  ->on('feeds')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_images');
    }
};