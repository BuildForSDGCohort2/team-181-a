<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantRegimentRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_regiment_recs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('plantation_id');
            $table->unsignedBigInteger('regiment_id');
            $table->foreign('regiment_id')->references('id')->on('plant_dev_regiments');
            $table->foreign('plantation_id')->references('id')->on('plantations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_regiment_recs');
    }
}
