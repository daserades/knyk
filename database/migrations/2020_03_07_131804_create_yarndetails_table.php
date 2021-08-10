<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarndetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarndetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('yarn_id');
            $table->integer('barcode');
            $table->integer('yarnno')->nullable();
            $table->integer('ne')->nullable();
            $table->string('color')->nullable();
            $table->string('colorno')->nullable();
            $table->string('lotno')->nullable();
            $table->integer('bobbin')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amountgross')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('users_id');
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
        Schema::dropIfExists('yarndetails');
    }
}
