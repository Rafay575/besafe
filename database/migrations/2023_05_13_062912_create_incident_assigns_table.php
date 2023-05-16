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
        Schema::create('incident_assigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id'); //e.g hazard_id, unsafe_behavior_id,fire_and_property_damage_id
            $table->string('form_name'); //such as hazard,unsafe_behavior,fire_and_property_damage
            $table->foreignId('assign_by')->references('id')->on('users')->constrained()->onDelete('cascade'); //assign by user
            $table->foreignId('assign_to')->references('id')->on('users')->constrained()->onDelete('cascade'); //assign to by user
            $table->boolean('allowed_assign')->default(0);
            $table->integer('assign_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_assigns');
    }
};