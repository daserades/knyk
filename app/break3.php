<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class break3 extends Model
{
    protected $table='break3s';
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
