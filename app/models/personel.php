<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class personel extends Model
{
    protected $table='personels';
    protected $fillable =['name','surname','tel','department_id','dutylists_tb_id','gtrh','ctrh','status_id','users_tb_id','adres'];

    public function operating()
	{
		return $this->belongsTo('App\models\operating','operating_id','id');
	}
	public function user()
	{
		return $this->belongsTo('App\User','users_tb_id','id');
	}
    public function status()
	{
		return $this->belongsTo('App\models\status','status_id','id');
	}
	public function department()
	{
		return $this->belongsTo('App\models\department','department_id','id');
	}
	public function dutylist()
	{
		return $this->belongsTo('App\models\dutylist','dutylists_tb_id','id');
	}
}
