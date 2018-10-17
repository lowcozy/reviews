<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    public $timestamps = false;
    
    public static function getParrent($id)
    {
    	return Category::where('parent', $id)->get();
    }

    public static function places()
    {
    	  return $this->hasMany('App\Models\Place');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category','parent');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\Category', 'parent');
    }
}
