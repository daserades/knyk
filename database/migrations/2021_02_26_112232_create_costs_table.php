<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
          $table->integer('order_id');
          $table->integer('firma_id');
          $table->integer('article_id');
          $table->string('article');
          $table->integer('pattern_id');
          $table->string('marticle');
          $table->integer('ordertype_id');
          $table->float('cne');
          $table->float('csik');
          $table->float('taren');
          $table->float('cgr');
          $table->float('cif');
          $table->integer('cif_kur');
          $table->float('hcf');
          $table->integer('hcf_kur');
          $table->float('oimc');
          $table->integer('oimc_kur');
          $table->float('cbf');
          $table->float('ane');
          $table->float('asik');
          $table->float('agr');
          $table->float('aif');
          $table->integer('aif_kur');
          $table->float('aft');
          $table->integer('aft_kur');
          $table->float('abf');
          $table->float('term');
          $table->integer('term_kur');
          $table->float('terf');
          $table->float('vf');
          $table->float('kar');
          $table->float('eur');
          $table->float('usd');
          $table->float('gbp');
          $table->float('hamf_eur');
          $table->float('hamf_usd');
          $table->float('hamf_gbp');
          $table->float('hamf_try');
          $table->float('hamsts_eur');
          $table->float('hamsts_usd');
          $table->float('hamsts_gbp');
          $table->float('hamsts_try');
          $table->float('mamsts_eur');
          $table->float('mamsts_usd');
          $table->float('mamsts_gbp');
          $table->float('mamsts_try');
          $table->float('hamvf_eur');
          $table->float('hamvf_usd');
          $table->float('hamvf_gbp');
          $table->float('hamvf_try');
          $table->float('mamvf_eur');
          $table->float('mamvf_usd');
          $table->float('mamvf_gbp');
          $table->float('mamvf_try');
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
        Schema::dropIfExists('costs');
    }
}
