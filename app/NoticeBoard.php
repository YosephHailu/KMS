<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    //
    protected $fillable = [
        'id','message', 'user_id', 'attachment', 'header', 'created_at'
    ];
     
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
