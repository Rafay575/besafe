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
        Schema::create('ie_audit_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ie_audit_clause_id')->constrained();
            $table->foreignId('meta_ie_audit_question_id')->constrained();
            $table->boolean('yes_or_no');
            $table->string('resposne')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ie_audit_answers');
    }
};