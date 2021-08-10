<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarnpaintdetail extends Model
{
    protected $table= 'yarnpaintdetails';
protected $fillable= ['yarnpaint_id','band_id','orderdetail_id','miktar','fiyat','exchange_id','aciklama','users_id'];

    public function order()
    {
        return $this->belongsTo('App\models\order');
    }
    public function yarnpaint()
    {
        return $this->belongsTo('App\models\yarnpaint');
    }
    public function yarn()
    {
        return $this->belongsTo('App\models\yarn');
    }
    public function exchange()
    {
        return $this->belongsTo('App\models\exchange');
    }
    
}
