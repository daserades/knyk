<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarntwist extends Model
{
     protected  $table='yarntwists';
    protected  $fillable=['no','name','order_id','company_id','explanation','status_id','users_id'];


    public function order()
    {
    	return $this->belongsTo('App\models\order');
    }
    public function company()
    {
    	return $this->belongsTo('App\models\company');
    }
    public function yarntwistdetail()
    {
    	return $this->hasMany(yarntwistdetail::class);
    }
      public function yarn()
    {
    	return $this->hasone(yarn::class);
    }

}
