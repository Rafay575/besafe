<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Check if the column already exists before adding
            if (!Schema::hasColumn('injuries', 'employee_id')) {
                Schema::table('injuries', function (Blueprint $table) {
                    $table->string('employee_id')->nullable(); // Add employee_id column
                });
            }
        } catch (Throwable $e) {
            // Log the error message
            Log::error('Migration failed for adding employee_id to injuries table: ' . $e->getMessage());
            // Rethrow the exception
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            // Check if the column exists before dropping it
            if (Schema::hasColumn('injuries', 'employee_id')) {
                Schema::table('injuries', function (Blueprint $table) {
                    $table->dropColumn('employee_id'); // Drop employee_id column if exists
                });
            }
        } catch (Throwable $e) {
            // Log the error message
            Log::error('Rollback failed for removing employee_id from injuries table: ' . $e->getMessage());
            // Rethrow the exception
            throw $e;
        }
    }
};
