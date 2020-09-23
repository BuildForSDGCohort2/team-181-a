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
            $table->string('id_number');

            #this is the mail where the text confirmation will mw sent
            $table->string('email')->unique();
            #ths will diferentiate between the vets and Feos
            $table->text('specialty');            
            $table->string('location');
            #used to check the supppliers availability
            #whwn the registration is confirmed be sure to make a user ...
            $table->integer('status')->default(0);#0,unconfirmed registration, 1-> confirmes,2->unavailable 
            $table->string('phone');
            #wll reate the supplies servicees..
            # they wil appear on the drop down according to the rating
            $table->integer('ratings')->default(0);
            $table->integer('exp');

            #am yet to knw how i will store the links to the s3 services... link the user to his / here cv

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
