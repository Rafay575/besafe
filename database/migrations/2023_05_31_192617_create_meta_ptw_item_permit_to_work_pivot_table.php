<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('meta_ptw_item_permit_to_work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_ptw_item_id')->constrained('meta_ptw_items')->onDelete('cascade');
            $table->foreignId('permit_to_work_id')->constrained('permit_to_works')->onDelete('cascade');
            // Add any additional columns to the pivot table if needed

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meta_ptw_item_permit_to_work');
    }
};