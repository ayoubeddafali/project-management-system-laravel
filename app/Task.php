<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'object',
        'status',
        'transmitter',
        'assigned',
        'priority',
        'category',
        'attached_milestone',
        'risk',
        'description',
        'start',
        'due',
        'project_id'
    ];

    protected $dates = [
        'start',
        'due'
    ];
  
    
    public function project(){
        return $this->belongsTo('App\Project');
    }
    
}
