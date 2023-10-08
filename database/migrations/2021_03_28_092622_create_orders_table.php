<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('suggestDate')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->unsignedBigInteger('super_id')->nullable();
            $table->foreign('super_id')->references('id')->on('admin')->onDelete('cascade');
            $table->unsignedBigInteger('technical_id')->nullable();
            $table->foreign('technical_id')->references('id')->on('admin')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
