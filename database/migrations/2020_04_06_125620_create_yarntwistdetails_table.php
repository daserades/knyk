<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarntwistdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarntwistdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('yarntwist_id');
            $table->integer('yarnstore_id');
            $table->integer('yarn_id');
            $table->integer('katsayi');
            $table->integer('tur');
            $table->string('yon');
            $table->integer('miktar');
            $table->integer('maxmiktar');
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
        Schema::dropIfExists('yarntwistdetails');
    }
}
