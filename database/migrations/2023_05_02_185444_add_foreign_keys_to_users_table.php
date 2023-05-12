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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('meta_unit_id')->nullable()->constrained('meta_units');
            $table->foreignId('meta_designation_id')->nullable()->constrained('meta_designations');
            $table->foreignId('meta_department_id')->nullable()->constrained('meta_departments');
            $table->foreignId('meta_line_id')->nullable()->constrained('meta_lines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['meta_department_id']);
            $table->dropForeign(['meta_line_id']);
            $table->dropForeign(['meta_unit_id']);
            $table->dropForeign(['meta_designation_id']);
        });
    }
};