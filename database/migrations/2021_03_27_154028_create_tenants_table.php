<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('anotherPhone')->nullable();
            $table->string('companyName')->nullable();
            $table->string('companyManger')->nullable();
            $table->string('companyMangerPhone')->nullable();
            $table->string('companyMangerEmail')->nullable();
            $table->string('password')->nullable();
            $table->string('contractNumber')->nullable();
            $table->string('contractDate')->nullable();
            $table->double('contractAmount',10,2)->nullable();
            $table->tinyInteger('contractType')->nullable();
            $table->unsignedBigInteger('villa_id')->nullable();
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
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
        Schema::dropIfExists('tenants');
    }
}
