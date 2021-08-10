<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class patterncolor extends Model
{
    protected $table='patterncolors';
    protected $fillable=[
            'pattern_id',
            'patterndetail_id',
            'variant_no',
            'band',
            'place1',
            'place2',
            'again1',
            'again2',
            'color'
    ];
}
