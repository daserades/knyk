<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table='orders';
    protected $fillable=['no','date','company_id','authorized_id','language_id','users_id'];

    public function authorized()
    {
    	return $this->belongsTo(authorized::class);
    }
    public function company()
    {
    	return $this->belongsTo(company::class);
    }
    public function language()
    {
    	return $this->belongsTo(language::class);
    }
    public function explanation()
    {
    	return $this->hasMany(explanation::class);
    }
    public function orderdetail()
    {
        return $this->hasMany(orderdetail::class);
    }
    public function orderitem()
    {
        return $this->hasMany(orderitem::class);
    }
    public function cost()
    {
        return $this->hasMany(cost::class);
    }
    public function orderproces()
    {
        return $this->hasOne(orderproces::class);
    }
    public function costprices()
    {
        return $this->hasMany(costprices::class);
    }

}
