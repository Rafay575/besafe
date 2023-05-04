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
        Schema::create('permit_to_works', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('initiated_by')->constrained('users')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('work_area');
            $table->string('line_machine')->nullable();
            $table->boolean('is_ptw_exist')->default(0);
            $table->string('cross_reference')->nullable();
            $table->boolean('moc_required')->default(1);
            $table->string('moc_title')->nullable();
            $table->string('moc_desc')->nullable();
            $table->foreignId('meta_ptw_type_id')->constrained();
            $table->string('working_group')->nullable();
            $table->string('worker_name')->nullable();
            $table->foreignId('meta_ptw_item_id')->constrained();
            $table->text('immediate_cause')->nullable();
            $table->text('root_cause')->nullable();
            $table->json('actions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_to_works');
    }
};