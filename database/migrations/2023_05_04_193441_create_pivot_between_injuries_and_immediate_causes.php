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
        Schema::create('meta_immediate_cuase_injury', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_immediate_cause_id')->constrained()->onDelete('cascade');
            $table->foreignId('injury_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_immediate_cuase_injury');
    }
};