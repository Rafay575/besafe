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
        Schema::create('unsafe_behaviors', function (Blueprint $table) {
            $table->id();
            // pivot unsafe behavior types is created. $table->meta_unsafe_behavior_type_id. many to many relationship
            $table->date('date');
            $table->foreignId('initiated_by')->constrained('users')->nullable();
            $table->foreignId('meta_unit_id')->constrained();
            $table->foreignId('meta_department_id')->constrained();
            $table->foreignId('meta_line_id')->constrained();
            $table->text('details')->nullable();
            $table->timestamps();
            // has 1 type of  files common_files
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unsafe_behaviors');
    }
};