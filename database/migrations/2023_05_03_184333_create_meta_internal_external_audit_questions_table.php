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
        Schema::create('meta_ie_audit_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_audit_type_id')->constrained();
            $table->string('question');
            $table->boolean('status')->default(1);
            $table->string('group_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_ie_audit_questions');
    }
};