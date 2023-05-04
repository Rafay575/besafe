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
        Schema::create('ie_audit_clauses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_audit_hall_id')->constrained();
            $table->foreignId('meta_audit_type_id')->constrained();
            $table->date('audit_date');
            $table->date('audit_end_date')->nullable();
            $table->string('auditor_name')->nullable();
            $table->boolean('can_rectify')->default(1);
            $table->string('audit_status')->default('in progress')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ie_audit_clauses');
    }
};