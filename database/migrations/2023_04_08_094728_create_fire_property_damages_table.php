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
        Schema::create('fire_property_damages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('initiated_by')->constrained('users');
            $table->string('reference')->nullable();
            $table->foreignId('meta_unit_id')->constrained();
            $table->string('location')->nullable();
            $table->foreignId('meta_fire_category_id')->constrained();
            $table->foreignId('meta_property_damage_id')->constrained();
            $table->foreignId('meta_incident_status_id')->default(1)->constrained();
            $table->text('description')->nullable();
            $table->text('immediate_action')->nullable();
            $table->text('immediate_cause')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('similar_incident_before')->nullable();
            $table->json('loss_calculation'); //table with two rows in template file
            $table->text('loss_recovery_method')->nullable();
            $table->text('preventative_measure')->nullable();
            $table->json('actions')->nullable();
            $table->timestamps();
            //  5 types of files to be uploaded in common-files
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_property_damages');
    }
};