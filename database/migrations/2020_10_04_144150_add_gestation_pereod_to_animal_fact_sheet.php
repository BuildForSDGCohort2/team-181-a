<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGestationPereodToAnimalFactSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animal_fact_sheets', function (Blueprint $table) {
            $table->integer('gestation_period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animal_fact_sheets', function (Blueprint $table) {
            $table->dropColumn('gestation_period');
        });
    }
}
