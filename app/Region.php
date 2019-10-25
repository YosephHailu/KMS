<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $fillable = [
        'id','name'
    ];
     
    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
