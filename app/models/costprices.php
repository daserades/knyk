<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costprices extends Model
{
    use HasFactory;
    protected $table='costprices';
    protected $fillable =['order_id','costtype_id','amount','unit_id','exchange_id','users_id'];

    public function exchange()
    {
        return $this->belongsTo(exchange::class);
    }
}
