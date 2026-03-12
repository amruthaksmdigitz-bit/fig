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
        Schema::table('feeds', function (Blueprint $table) {
            // Add is_hidden boolean (default false)
            $table->boolean('is_hidden')
                  ->default(false)
                  ->after('title');
            
            // Add report_count integer (default 0)
            $table->integer('report_count')
                  ->default(0)
                  ->after('is_hidden');
            
            // Add hidden_at timestamp
            $table->timestamp('hidden_at')
                  ->nullable()
                  ->after('report_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feeds', function (Blueprint $table) {
            // Drop the columns
            $table->dropColumn([
                'is_hidden',
                'report_count',
                'hidden_at'
            ]);
        });
    }
};