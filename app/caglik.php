<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caglik extends Model
{
	protected $table='caglik';
    protected $fillable=[
  'articleid',
  'article',
  'detayid',
  'ac',
  'ne',
  'adet',
  'cins',
  'renkno',
  'renk',
  'rgb',
  'tadet',
  'tt',
  'hgr',
  'mgr'
];

    
}
