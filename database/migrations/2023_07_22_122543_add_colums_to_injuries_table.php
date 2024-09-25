<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            Schema::table('injuries', function (Blueprint $table) {
                $table->foreignId('meta_department_id')->nullable()->constrained('meta_departments');
                $table->string('line')->nullable();
                $table->string('reference')->nullable();
                $table->time('time')->nullable();
                $table->string('injured_person')->nullable();
            });
        } catch (Throwable $e) { // Catch Throwable without importing it
            Log::error('Migration failed for injuries table: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('injuries', function (Blueprint $table) {
                $table->dropForeign(['meta_department_id']); // Drop the foreign key first
                $table->dropColumn('meta_department_id');
                $table->dropColumn('line');
                $table->dropColumn('reference');
                $table->dropColumn('time');
                $table->dropColumn('injured_person');
            });
        } catch (Throwable $e) { // Catch Throwable without importing it
            Log::error('Rollback failed for injuries table: ' . $e->getMessage());
            throw $e;
        }
    }
};
