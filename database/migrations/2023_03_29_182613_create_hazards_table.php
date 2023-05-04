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
        Schema::create('hazards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_unit_id')->constrained();
            $table->foreignId('initiated_by')->constrained('users');
            $table->foreignId('meta_department_id')->constrained();
            $table->foreignId('meta_line_id')->constrained();
            $table->foreignId('meta_risk_level_id')->constrained();
            $table->foreignId('meta_department_tag_id')->constrained();
            $table->foreignId('meta_incident_status')->constrained();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->date('date');
            $table->double('action_cost', 10, 2)->nullable(); //$10.20
            // $table->files it has attachements hasMany relation with common_attachements table.
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hazards');
    }
};