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
        Schema::table('near_misses', function (Blueprint $table) {
            $table->unsignedBigInteger('meta_unit_id')->nullable();
            $table->foreign('meta_unit_id')->references('id')->on('meta_units');
        });

        Schema::table('injuries', function (Blueprint $table) {
            $table->unsignedBigInteger('meta_unit_id')->nullable();
            $table->foreign('meta_unit_id')->references('id')->on('meta_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('near_misses', function (Blueprint $table) {
            $table->dropForeign(['meta_unit_id']);
            $table->dropColumn('meta_unit_id');
        });

        Schema::table('injuries', function (Blueprint $table) {
            $table->dropForeign(['meta_unit_id']);
            $table->dropColumn('meta_unit_id');
        });
    }
};