<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledHarvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_harvests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('plantation_id');
            $table->foreign('plantation_id')->references('id')->on('plantations');
            $table->unsignedBigInteger('transporter_id')->nullable();
            $table->foreign('transporter_id')->references('id')->on('users');
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
        Schema::dropIfExists('scheduled_harvests');
    }
}
