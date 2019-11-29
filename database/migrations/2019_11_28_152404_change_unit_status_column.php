<?php

use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUnitStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(Unit::AVAILABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->enum('status', ['available','unavailable','maintenance'])->default('available');
        });
    }
}
