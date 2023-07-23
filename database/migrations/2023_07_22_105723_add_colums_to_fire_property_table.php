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
        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->string('line')->nullable();
            $table->string('investigated_by')->nullable();
            $table->string('reviewed_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->dropColumn('line');
            $table->dropColumn('investigated_by');
            $table->dropColumn('reviewed_by');
        });
    }
};