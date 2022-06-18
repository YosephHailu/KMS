<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class knowledgeCategory extends Model
{
    //
    protected $fillable = [
        'id','category'
    ];
     
    public function knowledgeProduct()
    {
        return $this->hasMany('App\KnowledgeProduct');
    }
}
