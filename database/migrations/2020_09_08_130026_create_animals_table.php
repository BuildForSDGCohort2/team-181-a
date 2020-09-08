<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            #when harvettd or put up for sale it will be filled .. 
            $table->timestamps();
            $table->string('name');
            $table->string('species');
            $table->string('gender');
            $table->dateTime('birthday');
            $table->string('weight');
            // this will be used to check if the animal is pregnant or not
            $table->string('reproductive_status');
            // this will be used to check if the animal is healthy(0) or sick(1) or very sick(2)
            $table->integer('health_status');
            $table->unsignedBigInteger('farmer_id');
            // the breed id will hel in matching recomendations to the actual animal
            $table->unsignedBigInteger('breed_id');
            // if bought mother id is 0
            $table->integer('mother_id')->default(0);
            // if fathe is unknown 0 too,1 for AI
            $table->integer('father_id');
            //when the animal is in its priome the farmer will be adviced by the system to sell it.. 
            // if he aggrees, this is the var that l change  making the commodity up for sale 
            $table->integer('sale_status');            
            $table->foreign('farmer_id')->references('id')->on('farmers');
            $table->foreign('breed_id')->references('id')->on('animal_fact_sheets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
