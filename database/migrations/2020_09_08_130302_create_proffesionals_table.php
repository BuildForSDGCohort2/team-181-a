<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProffesionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proffesionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            #ths will diferentiate between the vets and Feos
            $table->integer('category');            
            $table->string('location');
            #used to check the supppliers availability
            $table->integer('status');
            $table->string('phone');
            #wll reate the supplies servicees..
            # they wil appear on the drop down according to the rating
            $table->integer('ratings');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proffesionals');
    }
}
