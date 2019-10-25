<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'document_category_id', 'issued_date'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
    
    public function documentCategory()
    {
        return $this->belongsTo('App\DocumentCategory');
    }
}
