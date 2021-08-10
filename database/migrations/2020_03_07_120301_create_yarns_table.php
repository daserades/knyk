<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('movementkind_id');
            $table->integer('order_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->date('logindate')->nullable();
            $table->date('outdate')->nullable();
            $table->integer('companytype_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('exchange_id')->nullable();
            $table->string('dispatchno')->nullable();
            $table->string('invoiceno')->nullable();
            $table->longText('explanation')->nullable();
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
        Schema::dropIfExists('yarns');
    }
}
