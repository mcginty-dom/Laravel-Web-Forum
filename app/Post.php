<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    /*
    public function timeCreated()
    {
      return $this->hasOne('App\TimeCreated')
    }
    */

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    /*
    public function tags()
    {
      return $this->hasMany('App\Tag');
    }
    */
}
