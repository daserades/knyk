<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class authorized extends Model
{
    protected $table= 'authorizeds';
    protected $fillable= ['name','surname','company_id','dutylist_id','telephone','mobilephones','email','explanation','users_id'];
	public function company ()
    {
    	return $this->belongsTo('App\models\company','company_id','id');
    }
    public function tesis ()
    {
    	return $this->belongsTo('App\models\tesis','tesis_id','id');
    }
    public function dutylist ()
    {
    	return $this->belongsTo('App\models\dutylist','dutylist_id','id');
    }
}
