<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['food_id','day'];



    public function food(){
        return $this->belongsTo('App\Food');
    }
}



