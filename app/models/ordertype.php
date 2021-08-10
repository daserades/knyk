<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ordertype extends Model
{
	protected $table='ordertypes';
	protected $fillable =['name','no'];
}
