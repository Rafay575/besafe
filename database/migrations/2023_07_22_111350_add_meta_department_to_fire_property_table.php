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
            $table->foreignId('meta_department_id')->nullable()->constrained('meta_departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fire_property_damages', function (Blueprint $table) {
            $table->dropColumn('meta_department_id');
        });
    }
};