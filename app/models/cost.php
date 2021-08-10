<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cost extends Model
{
    protected $table='costs';
    protected $fillable=[
	  'order_id',
	  'company_id',
	  'article_id',
	  'article',
	  'pattern_id',
	  'marticle',
	  'ordertype_id',
	  'cne',
	  'csik',
	  'taren',
	  'cgr',
	  'cif',
	  'cif_kur',
	  'hcf',
	  'hcf_kur',
	  'oimc',
	  'oimc_kur',
	  'cbf',
	  'ane',
	  'asik',
	  'agr',
	  'aif',
	  'aif_kur',
	  'aft',
	  'aft_kur',
	  'abf',
	  'term',
	  'term_kur',
	  'terf',
	  'vf',
	  'kar',
	  'eur',
	  'usd',
	  'gbp',
	  'hamf_eur',
	  'hamf_usd',
	  'hamf_gbp',
	  'hamf_try',
	  'hamsts_eur',
	  'hamsts_usd',
	  'hamsts_gbp',
	  'hamsts_try',
	  'mamsts_eur',
	  'mamsts_usd',
	  'mamsts_gbp',
	  'mamsts_try',
	  'hamvf_eur',
	  'hamvf_usd',
	  'hamvf_gbp',
	  'hamvf_try',
	  'mamvf_eur',
	  'mamvf_usd',
	  'mamvf_gbp',
	  'mamvf_try',
	  'users_id'
    ];
    public function ordertype()
    {
    	return $this->belongsTo(ordertype::class);
    }
}
