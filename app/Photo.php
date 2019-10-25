<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'photographer', 'event_date'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
}
