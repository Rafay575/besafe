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
        Schema::table('injuries', function (Blueprint $table) {
            $table->foreignId('meta_department_id')->nullable()->constrained('meta_departments');
            $table->string('line')->nullable();
            $table->string('reference')->nullable();
            $table->time('time')->nullable();
            $table->string('injured_person')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('injuries', function (Blueprint $table) {
            $table->dropColumn('meta_department_id');
            $table->dropColumn('line');
            $table->dropColumn('reference');
            $table->dropColumn('time');
            $table->dropColumn('injured_person');
        });
    }
};