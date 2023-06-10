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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_of'); //such as hazard,unsafe_behavior,fire_and_property_damage
            $table->string('file_path'); //name of each file
            $table->string('file_name'); //name of each file
            $table->date('from_date')->nullable(); //name of each file
            $table->date('to_date')->nullable(); //name of each file
            $table->foreignId('user_id')->constrained(); //uploaded by user
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};