<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table='companys';
    protected $fillable=['name','companytype_id','unvan','vergidairesi','verginumarasi','tel1','tel2','fax1','fax2','email1','email2','banka','sube','hesapno','iban','website','status_id','yesno_id','aciklama','users_id'];

    
     public function companytype ()
    {
    	return $this->belongsTo('App\models\companytype','companytype_id','id');
    }
     public function status ()
    {
    	return $this->belongsTo('App\models\status','status_id','id');
    }
     public function yesno ()
    {
    	return $this->belongsTo('App\models\yesno','yesno_id','id');
    }
    public function adress ()
    {
        return $this->hasMany(adress::class);
    }
}
