<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class harman extends Model
{
       protected $table='harman';
    protected $fillable=[
  'articleid',
  'ac',
  'ne',
  'neadet',
  'necins',
  'ipcins',
  'itt',
  'igr',
  'username'
    ];

    // public function article()
    // {
    //   return $this->belogsTo('App\article','articleid','id');
    // }

}
