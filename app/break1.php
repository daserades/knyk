<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class break1 extends Model
{
     protected $table='break1s';
    protected $fillable=[
            'design_name',
            'epi',
            'reed_space',
            'finish_width',
            'ppi',
            'total_dents',
            'total_ends',
            'grey_construction',
            'grey_construction1',
            'grey_construction2',
            'finish_construction',
            'finish_construction1',
            'finish_construction2',
            'reed_count',
            'average_dent',
            'gray_width',
            'gray_glm',
            'finish_glm',
            'warp_pattern',
            'weft_pattern',
            'weft_total',
            'draft_total',
            'draft_total1',
            'draft_total2',
            'pegptan_total',
            'warp_total',
            'aciklama',
            'marticle',
            'ozellik',
            'comp',
            'firma_id',
            'ordertype_id',
            'type_id',
            'users_id'
    ];

    public function break2()
    {
      return $this->hasMany('App\break2','pattern_id','id');
    }
    public function break3()
    {
      return $this->hasMany('App\break3','pattern_id','id');
    }

}
