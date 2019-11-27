<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('reservations', 'start_datetime')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->dropColumn('start_datetime');
                $table->dropColumn('end_datetime');
            });
        }
    }
}
