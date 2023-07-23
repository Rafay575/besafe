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
        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->text('action')->nullable();
            $table->foreignId('meta_risk_level_id')->nullable()->constrained('meta_risk_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->dropColumn('action');
            $table->dropColumn('meta_risk_level_id');
        });
    }
};