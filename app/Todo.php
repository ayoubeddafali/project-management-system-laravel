<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    
    protected $fillable = [
        'description',
        'user_id',
        'due'
        
    ];
    protected $dates = ['due'];
    public function setDueAttribute($date){
        $this->attributes['due'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function user(){
        return $this->belongsTo('App\User');
    } 
    
}
