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
        Schema::table('ie_audit_clauses', function (Blueprint $table) {
            $table->foreignId('initiated_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ie_audit_clauses', function (Blueprint $table) {
            $table->dropColumn('initiated_by');
        });
    }
};