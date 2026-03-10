<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('feed_id');
            $table->unsignedBigInteger('reported_user_id');
            $table->text('message');
            $table->string('screenshot')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('feed_id')->references('id')->on('feeds')->onDelete('cascade');
            $table->foreign('reported_user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes for better performance
            $table->index('reporter_id');
            $table->index('feed_id');
            $table->index('reported_user_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};