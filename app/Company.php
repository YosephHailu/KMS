<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'id', 'name', 'abbreviation', 'email','address', 'phone',
        'fixed_line','fax', 'website', 'url', 'fb_url', 'twitter_url',
        'youtube_url', 'logo', 'header_img',
    ];
}
