<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class adress extends Model
{
    protected $table='adresses';
    protected $fillable=['company_id','type','place','countries_id','cities_id','text','users_id'];

    public function firma ()
    {
    	return $this->belongsTo(firma::class);
    }
    public function country ()
    {
    	return $this->belongsTo('App\models\country','countries_id','id');
    }
    public function city ()
    {
    	return $this->belongsTo('App\models\city','cities_id','id');
    }
}
