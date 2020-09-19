<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdRateToPlantFactSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plant_fact_sheets', function (Blueprint $table) {
            $table->integer('production_rate')->after('months_to_maturity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plant_fact_sheets', function (Blueprint $table) {
           $table->dropColumn('production_rate');
        });
    }
}
