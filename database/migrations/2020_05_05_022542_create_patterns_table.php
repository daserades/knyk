<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patterns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('design_name')->nullable();
            $table->string('epi')->nullable();
            $table->string('reed_space')->nullable();
            $table->string('finish_width')->nullable();
            $table->string('ppi')->nullable();
            $table->string('total_dents')->nullable();
            $table->string('total_ends')->nullable();
            $table->string('grey_construction')->nullable();
            $table->string('grey_construction1')->nullable();
            $table->string('grey_construction2')->nullable();
            $table->string('finish_construction')->nullable();
            $table->string('finish_construction1')->nullable();
            $table->string('finish_construction2')->nullable();
            $table->string('reed_count')->nullable();
            $table->string('average_dent')->nullable();
            $table->string('gray_width')->nullable();
            $table->string('gray_glm')->nullable();
            $table->string('finish_glm')->nullable();
            $table->string('warp_pattern')->nullable();
            $table->string('weft_pattern')->nullable();
            $table->string('weft_total')->nullable();
            $table->string('draft_total')->nullable();
            $table->string('draft_total1')->nullable();
            $table->string('draft_total2')->nullable();
            $table->string('pegptan_total')->nullable();
            $table->string('warp_total')->nullable();
            $table->longText('aciklama')->nullable();
            $table->string('marticle')->nullable();
            $table->string('ozellik')->nullable();
            $table->string('comp')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('ordertype_id')->nullable();
            $table->integer('type_id')->nullable();
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
        Schema::dropIfExists('patterns');
    }
}
