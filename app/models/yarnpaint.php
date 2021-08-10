<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarnpaint extends Model
{
     protected  $table='yarnpaints';
    protected  $fillable=['no','company_id','order_id','explanation','users_id'];

    public function company()
    {
    	return $this->belongsTo('App\models\company');
    }
    public function yarnpaintdetail()
    {
    	return $this->hasMany('App\models\yarnpaintdetail');
    }
    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
      public function yarn()
    {
    	return $this->hasone(yarn::class);
    }
}
