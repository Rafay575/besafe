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
        Schema::table('injuries', function (Blueprint $table) {
            $table->string('other_location')->nullable();
        });

        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->string('other_location')->nullable();
        });

        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->string('other_location')->nullable();
        });

        Schema::table('near_misses', function (Blueprint $table) {
            $table->string('other_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('injuries', function (Blueprint $table) {
            $table->dropColumn('other_location');
        });

        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->dropColumn('other_location');
        });

        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->dropColumn('other_location');
        });

        Schema::table('near_misses', function (Blueprint $table) {
            $table->dropColumn('other_location');
        });
    }
};