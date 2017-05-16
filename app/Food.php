<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['name', 'price', 'category_id',];

    public function photo()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
