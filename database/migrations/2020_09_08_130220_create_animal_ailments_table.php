<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalAilmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_ailments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            #this wil be used to differentiate between the plant and animak ailments
            $table->integer('category');
            $table->string('name');
            // the scale will tell the severity of the infection
            $table->integer('scale');
            $table->string('cause');
            $table->string('symptoms');
            $table->string('prevention');
            #this wil be in the format 04 -- 09 
            #reprenting the months
            $table->string('peak_times');
            $table->text('counter_measure');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal__ailments');
    }
}
