<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from',
        'to',
        'content',
        'subject'
    ];
    
   

    public function from() {
        return $this->belongsTo('App\User', 'from');
    }

    public function to() {
        return $this->belongsTo('App\User', 'to');
    }
}
