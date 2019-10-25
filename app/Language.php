<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $fillable = [
        'id','abbreviation', 'name', 'created_at','updated_at'
    ];
}
