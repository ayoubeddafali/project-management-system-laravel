<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected  $fillable = [
        'emetteur',
        'date_declaree',
        'sujet',
        'message'
    ];
    
    public $dates = ['date_declaree'];
    
    
    public function projects(){
        return $this->belongsToMany('App\Project');
    }
}


 