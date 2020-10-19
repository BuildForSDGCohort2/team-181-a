<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantations', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->timestamps();
            // eg maize
            $table->string('species');
            $table->dateTime('planting_date');
            $table->unsignedBigInteger('user_id');
            $table->integer('size_of_plantation');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('plant_fact_sheets');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantations');
    }
}
