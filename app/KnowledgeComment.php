<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgeComment extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'document_category_id', 'message', 'user_id'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
