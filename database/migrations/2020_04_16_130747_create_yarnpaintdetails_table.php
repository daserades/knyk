,<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnpaintdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarnpaintdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('yarnpaint_id');
            $table->integer('yarnstore_id');
            $table->integer('yarndetail_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('iplikseridi_id');
            $table->integer('miktar');
            $table->double('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->longText('aciklama')->nullable();
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
        Schema::dropIfExists('yarnpaintdetails');
    }
}
