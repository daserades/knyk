<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderprocesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderproces', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('colortype_id')->nullable();
            $table->integer('finishproces_id')->nullable();
            $table->integer('sardon')->nullable();
            $table->integer('liza')->nullable();
            $table->integer('lycra')->nullable();
            $table->integer('gofre')->nullable();
            $table->integer('partwash')->nullable();
            $table->integer('sanfor')->nullable();
            $table->string('sanfortest')->nullable();
            $table->string('touchfeature')->nullable();
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
        Schema::dropIfExists('orderproces');
    }
}
