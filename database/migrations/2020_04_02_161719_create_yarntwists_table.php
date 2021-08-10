<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarntwistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarntwists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no');
            $table->string('name');
            $table->integer('company_id');
            $table->integer('order_id')->nullable();
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
        Schema::dropIfExists('yarntwists');
    }
}
