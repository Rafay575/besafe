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
        Schema::table('hazards', function (Blueprint $table) {
            $table->text('others')->nullable();
            $table->text('action')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hazards', function (Blueprint $table) {
            $table->dropColumn('others');
            $table->dropColumn('action');
        });
    }
};