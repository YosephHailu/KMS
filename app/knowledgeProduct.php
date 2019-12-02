<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class knowledgeProduct extends Model
{
    protected $fillable = [
        'id', 'title', 'directorate_id', 'source', 'contact', 'keywords', 
        'knowledge_description', 'knowledge_category_id', 'access_level_id',
         'views', 'user_id', 'approved', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function directorate()
    {
        return $this->belongsTo('App\Directorate');
    }

    public function knowledgeCategory()
    {
        return $this->belongsTo('App\KnowledgeCategory');
    }

    public function accessLevel()
    {
        return $this->belongsTo('App\AccessLevel');
    }

    public function project()
    {
        return $this->hasOne('App\Project');
    }

    public function document()
    {
        return $this->hasOne('App\Document');
    }

    public function photo()
    {
        return $this->hasOne('App\Photo');
    }

    public function video()
    {
        return $this->hasOne('App\Video');
    }

    public function map()
    {
        return $this->hasOne('App\Map');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function knowledgeComment()
    {
        return $this->hasMany('App\KnowledgeComment');
    }

    public function knowledgeRating()
    {
        return $this->hasMany('App\KnowledgeRating');
    }

    public function kmLike()
    {
        return $this->hasMany('App\KmLike');
    }
    public function ratting()
    {
        return $this->hasMany('App\Ratting');
    }
    public function Report()
    {
        return $this->hasOne('App\Report');
    }
}
