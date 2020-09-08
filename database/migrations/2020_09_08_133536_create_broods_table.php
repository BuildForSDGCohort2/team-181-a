<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('date_of_hatching');
            $table->unsignedBigInteger('breed_id');
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
        Schema::dropIfExists('broods');
    }
}
