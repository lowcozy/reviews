<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

     public function images()
    {
        return $this->hasMany('App\Models\ImageComment','comment_id');
    }

    public function user()
    {
    	 return $this->belongsTo('App\User');
    }

     public function place()
    {
    	 return $this->belongsTo('App\Models\Place');
    }
}
