<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','logo'
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isATeamLeader($project_id){
        return Auth::user()->roles()->where(['role_id'=>Role::find(2),'project_id'=>$project_id]) == true ? true : false;
    }
    public function isOwner($user_id){
        return Auth::user()->id == $user_id ? true : false;
            }
    public function isAnAdmin(){
        return Auth::user()->role == 'admin' ? true : false ;
    }
//    public function setPasswordAttribute($password){
//        $this->attributes['password'] = bcrypt($password);
//    }
    public function todos(){
        return $this->hasMany('App\Todo');
    }
  
    public function projects(){
        return $this->belongsToMany('App\Project');
    }
    
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function messages() {
        return $this->hasMany('App\Message', 'to');
    }

    public function sent_messages() {
        return $this->hasMany('App\Message', 'from');
    }


}
