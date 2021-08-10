<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table='articles';
    protected $fillable=[
  'no',
  'varyant',
  'isim',
  'tip',
  'seri',
  'ozellik',
  'comp',
  'cne',
  'cneadet',
  'cnecins',
  'cipcins',
  'citt',
  'ane',
  'aneadet',
  'anecins',
  'aipcins',
  'aitt',
  'csik',
  'asik',
  'targ',
  'ctel',
  'nm',
  'cek',
  'taren',
  'orgu',
  'marticle',
  'musteri',
  'hamen',
  'hamgr',
  'mamen',
  'mamgr',
  'icgr',
  'iagr',
  'cgr',
  'agr',
  'oipfiyat',
  'oipkur',
  'ack',
  'desenack',
  'projeid',
  'date',
  'username'
    ];

    public function harman()
    {
    	return $this->hasMany('App\harman','articleid','id');
    }
    public function caglik()
    {
      return $this->hasMany('App\caglik','articleid','id');
    }
}
