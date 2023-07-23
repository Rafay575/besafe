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
        Schema::table('near_misses', function (Blueprint $table) {
            $table->foreignId('meta_department_id')->nullable()->constrained('meta_departments');
            $table->string('shift')->nullable();
            $table->foreignId('meta_near_miss_class_id')->nullable()->constrained('meta_near_miss_classes');
            $table->boolean('person_involved')->default(0);
            $table->text('persons')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('initial_recommendation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('near_misses', function (Blueprint $table) {
            $table->dropColumn('meta_department_id');
            $table->dropColumn('shift');
            $table->dropColumn('meta_near_miss_class_id');
            $table->dropColumn('person_involved');
            $table->dropColumn('persons');
            $table->dropColumn('witness_name');
            $table->dropColumn('initial_recommendation');
        });
    }
};