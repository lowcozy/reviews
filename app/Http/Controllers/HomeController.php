<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Category;

class HomeController extends Controller
{
    public function home(Request $request)
    {	
    	$places = Place::where('status', 0)->orderBy('count_views', 'DESC')->paginate(3);
    	$categories = Category::getParrent(0);
    	return view('home', ['places' => $places, 'categories'=> $categories]);
    }
}
