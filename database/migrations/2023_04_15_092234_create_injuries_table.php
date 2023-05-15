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
        Schema::create('injuries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initiated_by')->constrained('users');
            $table->foreignId('meta_injury_category_id')->constrained();
            $table->foreignId('meta_incident_category_id')->constrained();
            $table->foreignId('meta_incident_status_id')->default(1)->constrained();
            $table->string('employee_involved')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('sgfl_relation')->nullable(); //contractor or sgfl employee
            $table->text('details')->nullable();
            $table->string('immediate_action')->nullable();
            $table->text('key_finding')->nullable();
            // pivot meta_immediate_causes
            // pivot meta_root_causes
            // pivot meta_basic_causes
            // pivot type of meta_type_contact
            // two types of attachements
            $table->timestamps();

            // not completed. need guidance.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('injuries');
    }
};