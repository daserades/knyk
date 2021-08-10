<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yarntwistdetail extends Model
{
    protected $table= 'yarntwistdetails';
    protected $fillable= ['yarntwist_id','yarnstore_id','yarndetail_id','katsayi','tur','yon','miktar','maxmiktar','aciklama','users_id'];

    public function yarntwist()
    {
    	return $this->belongsTo(yarntwist::class);
    }
    public function yarnstore()
    {
    	return $this->hasOne('App\models\yarnstore','id','yarnstore_id');
    }
     public function yarndetail()
    {
        return $this->hasOne('App\models\yarndetail','id','yarndetail_id');
    }

}
