<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    //
    protected $fillable = [
        'id','status'
    ];
     
    public function user()
    {
        return $this->hasMany('App\User');
    }
    
}
