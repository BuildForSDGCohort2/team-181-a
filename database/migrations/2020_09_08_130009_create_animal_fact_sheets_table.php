<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalFactSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_fact_sheets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('species');
            $table->integer('prime_age');
            $table->integer('reproductive_age');
            $table->integer('maximum_prod_rate');
            $table->integer('maximum_weight');
            $table->integer('maximum_height');
            $table->integer('weight_at_birth');
            $table->string('breed');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal__fact_sheets');
    }
}
