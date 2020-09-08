<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            #plant or animal
            $table->integer('category');
            #the product thats to be planted
            $table->integer('input_id');
            $table->text('precations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precations');
    }
}
