<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgeRegimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_regiments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('category');
            $table->unsignedBigInteger('breed_id');
            #when an animal or plantaion is between these ages it will be automatically suggested to the farmer to aply the suppliment
            $table->string('age_limits');
            $table->string('suppliment');
            $table->text('tips');
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
        Schema::dropIfExists('age__regiments');
    }
}
