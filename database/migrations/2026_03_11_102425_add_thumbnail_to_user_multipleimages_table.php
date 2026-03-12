<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_multipleimages', function (Blueprint $table) {
            // Add thumbnail column
            $table->string('thumbnail')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('user_multipleimages', function (Blueprint $table) {
            // Drop thumbnail if rolling back
            $table->dropColumn('thumbnail');
        });
    }
};
