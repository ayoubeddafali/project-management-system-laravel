<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cout extends Model
{
    protected  $fillable = [
        'libelle',
        'pmh',
        'bca',
        'actif',
        'commentaire'
    ];
    public $timestamps =  false;
    public function projects(){
        return $this->hasMany('App\Project');
    }
}
