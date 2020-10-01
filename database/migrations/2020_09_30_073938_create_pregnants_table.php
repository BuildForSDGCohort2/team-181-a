<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnants', function (Blueprint $table) {
            $table->id();
            $table->integer('pregnancy_status');
            $table->date('pregnancy_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('proffesional_id')->nullable();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('proffesional_id')->references('id')->on('proffesionals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnants');
    }
}
