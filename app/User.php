<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password','directorate_id', 'sales_store_id' ,'job_title','photo','phone','username','created_at','user_status_id', 'access_level_id','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function directorate()
    {
        return $this->belongsTo('App\Directorate');
    }
    
    public function userStatus()
    {
        return $this->belongsTo('App\UserStatus');
    }

    public function knowledgeProduct()
    {
        return $this->hasMany('App\KnowledgeProduct');
    }
    
    public function accessLevel(){
        return $this->belongsTo('App\AccessLevel');
    }

    public function userLog(){
        return $this->hasMany('App\UserLog');
    }

}
