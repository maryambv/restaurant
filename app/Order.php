<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['food_id','user_id','count','status'];

    public function food(){
        return $this->belongsTo('App\Food');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
