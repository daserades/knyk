<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreak2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('break2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pattern_id');
            $table->integer('variant_no')->nullable();
            $table->integer('place')->nullable();
            $table->integer('band')->nullable();
            $table->string('yarn_name')->nullable();
            $table->float('quantity')->nullable();
            $table->float('picksrpt')->nullable();
            $table->float('tp')->nullable();
            $table->string('yarncount')->nullable();
            $table->float('ne')->nullable();
            $table->float('no')->nullable();
            $table->string('colorrgb')->nullable();
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
        Schema::dropIfExists('break2s');
    }
}
