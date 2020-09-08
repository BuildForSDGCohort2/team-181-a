<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantDevRegimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_dev_regiments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('plant_id');
            #when an animal or plantaion is between these ages it will be automatically suggested to the farmer to aply the suppliment
            $table->string('age_limits');
            $table->string('suppliment');
            $table->text('tips');
            $table->foreign('plant_id')->references('id')->on('plant_fact_sheets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_dev_regiments');
    }
}
