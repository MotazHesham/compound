<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('villa_number')->nullable();
            $table->string('number_of_rooms')->nullable();
            $table->string('number_of_bathrooms')->nullable();
            $table->string('other_details')->nullable();
            $table->unsignedBigInteger('compound_id')->nullable();
            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
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
        Schema::dropIfExists('villas');
    }
}
