<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFinance extends Model
{
    //
    protected $fillable = [
        'finance_id', 'budget', 'unit_id', 'project_id', 'created_at','updated_at'
    ];

    public function finance(){
        return $this->belongsTo('App\Finance');
    }
    
    public function unit(){
        return $this->belongsTo('App\Unit');
    }
}
