<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeRating extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id','user_id','rating'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function knowledgeProduct(){
        return $this->belongsTo('App\KnowledgeProduct');
    }
}
