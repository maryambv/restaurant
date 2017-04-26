<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->morphMany('App\Photo', 'imageable');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }


    public function isAdmin(){
        if ($this->role->name =="Administrator"){

            return true;
        }
        return false;
    }
}
