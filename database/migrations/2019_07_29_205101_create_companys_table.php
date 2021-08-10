<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('companytype_id');
            $table->string('unvan');
            $table->string('vergidairesi');
            $table->string('verginumarasi');
            $table->integer('tel1');
            $table->integer('tel2');
            $table->integer('fax1');
            $table->integer('fax2');
            $table->string('email1');
            $table->string('email2');
            $table->string('banka');
            $table->string('sube');
            $table->string('hesapno');
            $table->string('iban');
            $table->string('website');
            $table->integer('status_id');
            $table->integer('yesno_id');
            $table->longText('aciklama');
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
        Schema::dropIfExists('companys');
    }
}
