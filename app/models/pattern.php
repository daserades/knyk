<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class pattern extends Model
{
    protected $table='patterns';
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
            'company_id',
            'ordertype_id',
            'type_id',
            'users_id'
    ];

    public function patterndetail()
    {
        return $this->hasMany(patterndetail::class);
    }
    public function patterncolor()
    {
        return $this->hasMany(patterncolor::class);
    }
    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
