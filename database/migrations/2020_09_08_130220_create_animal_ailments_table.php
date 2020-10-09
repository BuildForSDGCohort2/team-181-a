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
            $table->softDeletes();
            $table->id();
            $table->timestamps();
            #this wil be used to differentiate between the plant and animak ailments
            $table->unsignedBigInteger('animal_id'); 
            // the scale will tell the severity of the infection
            $table->integer('scale');
            $table->string('cause');
            $table->unsignedBigInteger('vet_id');
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('vet_id')->references('id')->on('users');

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
