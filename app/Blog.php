<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = [
        'id', 'title', 'sub_title', 'message','user_id', 'photo', 'created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
