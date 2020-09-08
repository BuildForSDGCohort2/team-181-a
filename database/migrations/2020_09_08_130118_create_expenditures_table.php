<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            #whether repairs vet charges etc
            $table->integer('category');
            $table->timestamps();
            #this will be automatically filled in  by the system when a farmer 
            #puchases a good or service for an animal or Plantation
            $table->string('cause');
            $table->integer('amount');
            $table->string('recipient_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenditures');
    }
}
