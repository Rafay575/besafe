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
        Schema::create('near_misses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->foreignId('initiated_by')->constrained('users');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('immediate_action')->nullable();
            $table->text('immediate_cause')->nullable();
            $table->text('root_cause')->nullable();
            $table->json('actions')->nullable();
            // $table->photographs it has hasMany relationship with common_attacement table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('near_misses');
    }
};