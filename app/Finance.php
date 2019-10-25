<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    //
    protected $fillable = [
        'id','donner_name', 'credit', 'contact','address','created_at','updated_at'
    ];
    
    public function projectFinance()
    {
        return $this->hasMany('App\ProjectFinance');
    }
}
