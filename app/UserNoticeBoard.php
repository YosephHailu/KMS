<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNoticeBoard extends Model
{
    //
    
    //
    protected $fillable = [
        'id','user_id', 'notice_board_id', 'seen', 'seen_at'
    ];
     
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function noticeBoard()
    {
        return $this->belongsTo('App\NoticeBoard');
    }
}
