<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarndetail extends Model
{
    protected  $table='yarndetails';
    protected  $fillable=['barcode','movementkind_id','place','yarn_id','yarnbrand','yarntype_id','colortype_id','yarnno','ne','color','colorno','colorsim','colornosim','bobbin','lotno','amount','amountgross','unit_id','users_id'];


    public function yarntype()
    {
    	return $this->belongsTo('App\models\yarntype');
    }
    public function movementkind()
    {
        return $this->belongsTo('App\models\movementkind');
    }
    public function yarn()
    {
    	return $this->belongsTo('App\models\yarn');
    }
    public function colortype()
    {
    	return $this->belongsTo('App\models\colortype');
    } 
    public function unit()
    {
    	return $this->belongsTo('App\models\unit');
    } 
}
