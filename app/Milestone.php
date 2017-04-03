<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'numero',
        'genre',
        'due',
        'dependance',
        'actif',
        'commentaire',
        'dependant',
        'livrable_type',
        'project_id'
    ];
    protected $dates = ['due'];
    
    public function project(){
        return $this->belongsTo('App\Project');
    }
}
