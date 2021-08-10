<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarnstore extends Model
{
    protected  $table='yarnstores';
    protected  $fillable=['yarn_id','movementkind_id','yarndetail_id','place','barcode','order_id','yarnbrand','yarntype_id','colortype_id','company_id','yarnno','ne','color','colorno','colorsim','colornosim','lotno','amount','amountgross','unit_id','bobbin','price','exchange_id','dispatchno','invoiceno','explanation','users_id'];


    public function yarndetail()
    {
        return $this->hasOne(yarndetail::class);
    }
    public function yarn()
    {
        return $this->belongsTo('App\models\yarn');
    }
    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function yarntype()
    {
    	return $this->belongsTo('App\models\yarntype');
    }
    public function company()
    {
    	return $this->belongsTo('App\models\company');
    }
    public function colortype()
    {
    	return $this->belongsTo('App\models\colortype');
    } 
    public function unit()
    {
    	return $this->belongsTo('App\models\unit');
    } 
    public function exchange()
    {
    	return $this->belongsTo('App\models\exchange');
    } 
}
