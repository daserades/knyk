<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class band extends Model
{
    protected $table='bands';
    protected $fillable=['name'];

    // public function patterndetail()
    // {
    //     return $this->belognsTo('App\models\patterndetail','id','band');
    // }
}
