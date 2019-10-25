<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    //
    
    protected $fillable = [
        'id','status'
    ];
     
    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
