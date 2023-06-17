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
            $table->foreignId('meta_unsafe_behavior_action_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unsafe_behaviors', function (Blueprint $table) {
            $table->dropColumn('meta_unsafe_behavior_action_id');
        });
    }
};