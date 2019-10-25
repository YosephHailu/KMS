<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    //
    protected $fillable = [
        'id','category'
    ];
     
    public function document()
    {
        return $this->hasMany('App\Document');
    }
}
