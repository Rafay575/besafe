<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEscalationTimeStartToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Add a new escalation_time_start column
            $table->timestamp('escalation_time_start')->nullable(); // Adjust the 'after' to the desired column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Remove the escalation_time_start column if the migration is rolled back
            $table->dropColumn('escalation_time_start');
        });
    }
}
