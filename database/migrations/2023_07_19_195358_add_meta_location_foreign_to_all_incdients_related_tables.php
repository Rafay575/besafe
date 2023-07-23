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
        $tables = ['injuries', 'near_misses', 'hazards', 'unsafe_behaviors', 'fire_property_damages'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('meta_location_id')->nullable();
                $table->foreign('meta_location_id')->references('id')->on('meta_locations');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['injuries', 'near_misses', 'hazards', 'unsafe_behaviors', 'fire_property_damages'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign(['meta_location_id']);
                $table->dropColumn('meta_location_id');
            });
        }
    }
};