<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class AdminController extends Controller
{
    public function dashboard()
    {
    	$places = Place::all();
    	$places = $places->sortByDesc(function($data) {
            return $data->rate;
        });
    	$places = $places->sortByDesc('count_views');
    	return view('Admin.dashboard')->with(compact('places'));
    }
}
