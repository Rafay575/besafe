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
            $table->unsignedBigInteger('meta_sgfl_relation_id')->nullable();
            $table->foreign('meta_sgfl_relation_id')->references('id')->on('meta_sgfl_relations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('injuries', function (Blueprint $table) {
            $table->dropColumn('meta_sgfl_relation_id');
        });
    }
};