<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patterndetail extends Model
{
    protected $table='patterndetails';
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

    public function pattern()
    {
        return $this->belongsTo(pattern::class);
    }
    public function bands()
    {
        return $this->belongsTo('App\models\band','band','id');
    }
}
