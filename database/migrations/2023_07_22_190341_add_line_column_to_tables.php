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
        // Add 'line' column to 'unsafe_behaviors' table
        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->string('line')->nullable();
        });

        // Add 'line' column to 'hazards' table
        Schema::table('hazards', function (Blueprint $table) {
            $table->string('line')->nullable();
        });

        // Add 'line' column to 'near_misses' table
        Schema::table('near_misses', function (Blueprint $table) {
            $table->string('line')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop 'line' column from 'unsafe_behaviors' table
        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->dropColumn('line');
        });

        // Drop 'line' column from 'hazards' table
        Schema::table('hazards', function (Blueprint $table) {
            $table->dropColumn('line');
        });

        // Drop 'line' column from 'near_misses' table
        Schema::table('near_misses', function (Blueprint $table) {
            $table->dropColumn('line');
        });
    }
};