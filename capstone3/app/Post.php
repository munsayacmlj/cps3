<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function topic() {
    	return $this->belongsTo('App\Topic');
    }

    public function comments() {
    	return $this->hasMany('App\Comment');
    }
}
