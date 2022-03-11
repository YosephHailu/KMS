<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'id', 'project_category_id', 'directorate_id', 'project_title','contract_no', 'project_description',
         'outcome', 'output', 'starting_date', 'end_date','beneficiaries_region', 'wereda_kebele',
         'manager','knowledge_description','access_level_id','user_id', 'knowledge_product_id','project_status_id','created_at','updated_at'
    ];

    protected $dates = [
        'starting_date', 'end_date'
    ];
 
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function knowledgeProduct(){
        return $this->belongsTo('App\KnowledgeProduct');
    }

    public function directorate(){
        return $this->belongsTo('App\Directorate');
    }
    
    public function projectStatus(){
        return $this->belongsTo('App\ProjectStatus');
    }
    
    public function projectCategory(){
        return $this->belongsTo('App\ProjectCategory');
    }
    
    public function accessLevel(){
        return $this->belongsTo('App\AccessLevel');
    }

    public function projectFinance()
    {
        return $this->hasMany('App\ProjectFinance');
    }
}
