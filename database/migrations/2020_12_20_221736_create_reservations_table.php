<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('aircraft_id');
            $table->unsignedInteger('passenger_id');
            $table->tinyInteger('row_number');
            $table->string('row_seat', 1)->comment('Ex. A, B or C');
            $table->timestamps();

            $table->foreign('passenger_id')->references('id')->on('passengers');
            $table->foreign('aircraft_id')->references('id')->on('aircraft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
