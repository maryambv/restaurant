<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=['name','price'];

    public function photo(){
        return $this->morphMany('App\Photo', 'imageable');
    }
}
