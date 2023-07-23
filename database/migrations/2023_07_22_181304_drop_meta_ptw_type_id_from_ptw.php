<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the foreign key constraint before dropping the column
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->dropForeign('permit_to_works_meta_ptw_type_id_foreign');
            $table->dropColumn('meta_ptw_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add the column back and recreate the foreign key constraint
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->foreignId('meta_ptw_type_id')->nullable()->constrained();
        });
    }
};