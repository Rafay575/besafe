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
        Schema::create('unsafe_behavior_and_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unsafe_behavior_id')->constrained();
            $table->foreignId('meta_unsafe_behavior_type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unsafe_behavior_and_type');
    }
};