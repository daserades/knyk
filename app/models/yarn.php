<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarn extends Model
{
     protected $table='yarns';
    protected $fillable = ['movementkind_id','companytype_id','yarntwist_id','yarnpaint_id','order_id','company_id','logindate','outdate','barcode_piece','price','exchange_id','dispatchno','invoiceno','explanation','users_id'];
    
     public function yarndetail()
    {
        return $this->hasMany('App\models\yarndetail');
    }
     public function movementkind()
    {
    	return $this->belongsTo('App\models\movementkind');
    }
    public function company()
    {
        return $this->belongsTo('App\models\company');
    } 
    public function order()
    {
    	return $this->belongsTo('App\models\order');
    } 
    public function exchange()
    {
    	return $this->belongsTo('App\models\exchange');
    }  
    public function companytype()
    {
    	return $this->belongsTo('App\models\companytype');
    }
}
