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
        Schema::create('meta_risk_levels', function (Blueprint $table) {
            $table->id();
            $table->string('risk_level_title');
            $table->string('risk_level_desc')->nullable();
            $table->integer('days_required')->nullable();
            $table->string('group_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_risk_levels');
    }
};