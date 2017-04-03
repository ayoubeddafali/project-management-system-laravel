<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $fillable = [
        'famille',
        'libelle',
        'type_mesure',
        'severite',
        'actif',
        'commentaire',
        'project_id'
    ];
    
    public function project(){
        return $this->belongsTo('App\Project');
    }
}
