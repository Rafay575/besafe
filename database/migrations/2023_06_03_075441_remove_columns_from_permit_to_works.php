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
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->dropColumn('immediate_cause');
            $table->dropColumn('root_cause');
            $table->dropColumn('actions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->text('immediate_cause')->nullable();
            $table->text('root_cause')->nullable();
            $table->json('actions')->nullable();
        });
    }
};