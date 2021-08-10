<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class varyant extends Model
{
    protected $table='varyants';
    protected $fillable = ['desen_id','iplikseridi_id','iplik_no','iplik_cinsi','renk_no','renk','renk_sayisi','aciklama','users_id'];

     public function desen ()
    {
    	return $this->belongsTo('App\models\desen','desen_id','id');
    } 
    public function iplikseridi ()
    {
    	return $this->belongsTo('App\models\iplikseridi','iplikseridi_id','id');
    } 
}
