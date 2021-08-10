<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class break2 extends Model
{
    protected $table='break2s';
    protected $fillable=[
            'pattern_id',
            'variant_no',
            'place',
            'band',
            'yarn_name',
            'quantity',
            'picksrpt',
            'tp',
            'yarncount',
            'ne',
            'no',
            'type',
            'colorrgb'
    ];

    public function break1()
    {
      return $this->belongsTo('App\break1','pattern_id','id');
    }
    public function break3()
    {
      return $this->hasMany('App\break3','patterndetail_id','id');
    }
}
