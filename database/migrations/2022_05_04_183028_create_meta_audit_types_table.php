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
        Schema::create('meta_audit_types', function (Blueprint $table) {
            $table->id();
            $table->string('audit_title');
            $table->string('audit_desc')->nullable();
            $table->integer('score_weight')->nullable();
            $table->boolean('status')->default(1);
            $table->string('occurance')->nullable();
            $table->string('group_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_audit_types');
    }
};