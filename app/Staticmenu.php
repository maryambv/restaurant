<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staticmenu extends Model
{
    protected $fillable = ['food_id'];



    public function food(){
        return $this->belongsTo('App\Food');
    }
}
