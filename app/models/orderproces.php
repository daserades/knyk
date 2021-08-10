<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderproces extends Model
{
    use HasFactory;

    protected $table='orderproces';
    protected $fillable =['order_id','colortype_id','finishproces_id','sardon','liza','lycra','gofre','partwash','sanfor','sanfortest','touchfeature','users_id'];
    public function colortype()
    {
        return $this->belongsTo(colortype::class);
    }
    public function finishproces()
    {
        return $this->belongsTo(finishproces::class);
    }
}
