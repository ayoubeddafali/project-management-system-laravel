<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'libelle',
        'libelle_long',
        'logo',
        'charte',
        'entreprise',
        'direction',
        'status',
        'fin',
        'debut',
        'chef',
        'continent',
        'pays',
        'site',
        'cout_id'
    ];



    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
        
    }
    public function milestones(){
        return $this->hasMany('App\Milestone');
    }

    public function files(){
        return $this->hasMany('App\File');
    }
    
    public function risks(){
        return $this->hasMany('App\Risk');
    }
    
    public function status(){
        return $this->belongsTo('App\Status');
    }
    public function cout(){
        return $this->belongsTo('App\Cout');
    }
    public function collaborations(){
        return $this->belongsToMany('App\Collaboration');
    }
    
    


}
