<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    
    protected $fillable = [
        'id','title', 'message', 'url', 'photo', 'active'
    ];
     
}
