<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'comment'
    ];
}
