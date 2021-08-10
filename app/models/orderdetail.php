<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{
    protected $table='orderdetails';
    protected $fillable=['order_id','pattern_id','patterndetail_id','article_id','cost_id','orderkind_id','marticle','color','const','finishwidth','bil','test','finishmt','deadline','graywidth','graymt','graydeadline','price','exchange_id','maturity','payment_exchange_id','pricetype_id','paymentexplanation','users_id'];

    public function order()
    {
    	return $this->belongsTo(order::class);
    }
    public function pattern()
    {
    	return $this->belongsTo(pattern::class);
    }
    public function patterndetail()
    {
    	return $this->hasMany(patterndetail::class);
    }
    public function article()
    {
    	return $this->belongsTo('App\article','article_id','id');
    }

    public function orderkind()
    {
        return $this->belongsTo(orderkind::class);
    }
    public function exchange()
    {
        return $this->belongsTo(exchange::class);
    }
    public function pricetype()
    {
        return $this->belongsTo(pricetype::class);
    }
    public function paymentexchange()
    {
        return $this->belongsTo('App\models\exchange','payment_exchange_id','id');
    }
    public function cost()
    {
    	return $this->hasOne(cost::class);
    }
}
