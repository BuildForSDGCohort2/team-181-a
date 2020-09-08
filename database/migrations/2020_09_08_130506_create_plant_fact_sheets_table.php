<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantFactSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_fact_sheets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('species');
            $table->string('type');
            $table->integer('optimal_conditions');
            $table->integer('months_to_maturity');
            $table->integer('shelf_life');
            $table->text('storage_meth');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_fact_sheets');
    }
}
