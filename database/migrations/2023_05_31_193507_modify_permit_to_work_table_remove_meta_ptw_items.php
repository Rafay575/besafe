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
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->dropForeign(['meta_ptw_item_id']);
            $table->dropColumn('meta_ptw_item_id');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permit_to_works', function (Blueprint $table) {
            $table->foreignId('meta_ptw_item_id')->constrained();
        });
    }
};