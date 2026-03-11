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
        Schema::table('reports', function (Blueprint $table) {
            // Add status column after screenshot
            $table->enum('status', ['pending', 'dismissed', 'resolved', 'action_taken'])
                  ->default('pending')
                  ->after('screenshot');
            
            // Add admin notes column
            $table->text('admin_notes')
                  ->nullable()
                  ->after('status');
            
            // Add reviewed_by column (admin who reviewed)
            $table->unsignedBigInteger('reviewed_by')
                  ->nullable()
                  ->after('admin_notes');
            
            // Add reviewed_at timestamp
            $table->timestamp('reviewed_at')
                  ->nullable()
                  ->after('reviewed_by');
            
            // Add foreign key constraint for reviewed_by
            $table->foreign('reviewed_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['reviewed_by']);
            
            // Drop the columns
            $table->dropColumn([
                'status',
                'admin_notes',
                'reviewed_by',
                'reviewed_at'
            ]);
        });
    }
};