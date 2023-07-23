<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Drop 'meta_line_id' foreign key from 'unsafe_behaviors' table
        if (Schema::hasColumn('unsafe_behaviors', 'meta_line_id')) {

            Schema::table('unsafe_behaviors', function (Blueprint $table) {
                $table->dropForeign(['meta_line_id']);
                $table->dropColumn('meta_line_id');
            });
        }

        // Drop 'meta_line_id' foreign key from 'hazards' table
        if (Schema::hasColumn('hazards', 'meta_line_id')) {

            Schema::table('hazards', function (Blueprint $table) {
                $table->dropForeign(['meta_line_id']);
                $table->dropColumn('meta_line_id');
            });
        }

        // Drop 'meta_line_id' foreign key from 'near_misses' table
        if (Schema::hasColumn('near_misses', 'meta_line_id')) {

            Schema::table('near_misses', function (Blueprint $table) {
                $table->dropForeign(['meta_line_id']);
                $table->dropColumn('meta_line_id');
            });
        }

        // Drop 'meta_line_id' foreign key from 'injuries' table
        if (Schema::hasColumn('injuries', 'meta_line_id')) {

            Schema::table('injuries', function (Blueprint $table) {
                $table->dropForeign(['meta_line_id']);
                $table->dropColumn('meta_line_id');
            });
        }
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // You can create a new migration to add the 'meta_line_id' column back
        // and re-add the foreign key constraints if you need to rollback the changes.
        // This down() method is empty as the dropping of foreign keys cannot be undone automatically.
    }

    /**
     * Check if a foreign key constraint exists on the given column in the given table.
     *
     * @param string $table
     * @param string $column
     * @return bool
     */
    private function hasForeignKey(string $table, string $column): bool
    {
        $schema = DB::getDoctrineSchemaManager();
        $tableDetails = $schema->listTableDetails($table);
        return $tableDetails->hasForeignKey($column);
    }
};