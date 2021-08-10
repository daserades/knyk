<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class machinenumber extends Model
{
    protected $table='machinenumbers';
    protected $fillable=['name','machinetype_id'];

    public function machinetype()
    {
    	return $this->belongsTo(machinetype::class);
    }
}
