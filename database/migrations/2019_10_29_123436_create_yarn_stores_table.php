<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarnstores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('barcode');
            $table->integer('yarn_id');
            $table->integer('order_id');
            $table->integer('yarntype_id');
            $table->integer('colortype_id');
            $table->integer('company_id');
            $table->integer('yarnno');
            $table->integer('ne');
            $table->string('color');
            $table->string('colorno');
            $table->string('lotno');
            $table->integer('amount');
            $table->integer('amountgross');
            $table->integer('unit_id');
            $table->integer('price');
            $table->integer('exchange_id');
            $table->integer('bobbin');
            $table->integer('dispatchno');
            $table->integer('invoiceno');
            $table->longText('explanation');
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
        Schema::dropIfExists('yarnstores');
    }
}
