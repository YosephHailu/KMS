<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    
    protected $fillable = [
        'id','link', 'name', 'created_at','updated_at'
    ];
}
