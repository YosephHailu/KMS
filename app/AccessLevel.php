<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    //
    protected $fillable = [
        'id', 'level', 'level_number'
    ];
     
    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function knowledgeProduct()
    {
        return $this->hasMany('App\KnowledgeProduct');
    }
}
