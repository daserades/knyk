<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class explanation extends Model
{
    protected $table='explanations';
    protected $fillable=['order_id','type','place','text','users_id'];

    public function order()
    {
    	return $this->belongsTo('App\models\order','id','order_id');
    }
}
