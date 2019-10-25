<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    //
    protected $fillable = [
        'id','name','description','contact','manager','created_at','updated_at'
    ];
     
    public function user()
    {
        return $this->hasMany('App\User');
    }
    
    public function knowledgeProduct()
    {
        return $this->hasMany('App\KnowledgeProduct');
    }
    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
