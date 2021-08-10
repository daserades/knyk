<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    protected $table='orderitems';
    protected $fillable=['order_id','contractitem_id','users_id'];

    public function contractitem()
    {
    	return $this->belongsTo(contractitem::class);
    }
}
