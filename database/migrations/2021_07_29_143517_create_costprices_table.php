<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostpricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costprices', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('costtype_id')->nullable();
            $table->double('amount')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('exchange_id')->nullable();
            $table->integer('users_id')->nullable();
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
        Schema::dropIfExists('costprices');
    }
}
