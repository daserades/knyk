<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('pattern_id')->nullable();
            $table->integer('patterndetail_id')->nullable();
            $table->integer('article_id')->nullable();
            $table->integer('orderkind_id')->nullable();
            $table->integer('cost_id')->nullable();
            $table->string('marticle')->nullable();
            $table->string('color')->nullable();
            $table->string('const')->nullable();
            $table->integer('finishwidth')->nullable();
            $table->string('bil')->nullable();
            $table->string('test')->nullable();
            $table->integer('finishmt')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('graywidth')->nullable();
            $table->integer('graymt')->nullable();
            $table->date('graydeadline')->nullable();
            $table->double('price')->nullable();
            $table->integer('exchange_id')->nullable();
            $table->integer('maturity')->nullable();
            $table->integer('payment_exchange_id')->nullable();
            $table->integer('pricetype_id')->nullable();
            $table->longText('paymentexplanation')->nullable();
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
        Schema::dropIfExists('orderdetails');
    }
}
