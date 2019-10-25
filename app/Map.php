<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //
    protected $fillable = [
        'id','knowledge_product_id', 'map_type_id', 'created_date'
    ];
     
    public function knowledgeProduct()
    {
        return $this->belongsTo('App\KnowledgeProduct');
    }
    
    public function mapType()
    {
        return $this->belongsTo('App\MapType');
    }
}
