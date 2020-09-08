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
            // eg maize number 560
            $table->integer('type_id');
            $table->dateTime('planting_date');
            $table->unsignedBigInteger('farmer_id');
            $table->integer('size_of_plantation');
            $table->foreign('farmer_id')->references('id')->on('farmers');
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
