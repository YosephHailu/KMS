<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'title', 'downloads', 'file_url'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
    
}
