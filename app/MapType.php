<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapType extends Model
{
    //
    protected $fillable = [
        'id','type'
    ];
    
    public function map()
    {
        return $this->hasMany('App\Map');
    }
}
