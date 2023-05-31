<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->foreignId('meta_fire_category_id')->nullable()->change();
            $table->foreignId('meta_property_damage_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->foreignId('meta_fire_category_id')->nullable(false)->change();
            $table->foreignId('meta_property_damage_id')->nullable(false)->change();
        });
    }
};