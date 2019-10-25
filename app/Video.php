<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'goal', 'created_date'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
}
