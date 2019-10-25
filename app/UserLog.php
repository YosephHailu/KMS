<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    //
    protected $fillable = [
        'id','date', 'remark', 'affected_url', 'affected_table', 'operation', 'action', 'user_id', 'created_at', 'updated_at'
    ];
     
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
