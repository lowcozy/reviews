<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class PlaceController extends Controller
{
    public function create()
    {
    	$file = 'local.json';
    	$cities = json_decode(file_get_contents($file));
    	$cats = Category::where('parent', 0)->get();
    	return view('Admin.place.create', ['cities' => $cities, 'cats' => $cats]);
    }
}
