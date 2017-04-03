<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'uploader_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
