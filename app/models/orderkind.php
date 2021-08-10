<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderkind extends Model
{
    protected $table='orderkinds';
    protected $fillable=['name'];
}
