<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatterncolorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patterncolors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pattern_id')->nullable();
            $table->integer('patterndetail_id')->nullable();
            $table->integer('variant_no')->nullable();
            $table->integer('place1')->nullable();
            $table->integer('place2')->nullable();
            $table->integer('again1')->nullable();
            $table->integer('again2')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('patterncolors');
    }
}
