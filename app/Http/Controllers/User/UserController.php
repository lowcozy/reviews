<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Models\Place;
use App\User;
use DB;
use App\Models\Comment;

class UserController extends Controller
{
    public function listing($id)
    {
    	$user = Sentinel::findById($id);
    	$places = Place::select('places.*')->where('status', 1)->where('author_id', $user->id)->paginate(3);

    	$place_id = Place::select('places.id')->where('author_id', $user->id)->get();

    	$reviews = Comment::select('comments.*')->whereIn('place_id', $place_id->toArray())
    	->orderBy('created_at', 'desc')
    	->where('user_id', '<>', $id)
    	->paginate(10);

    	return view('User.User.list', ['user'=> $user, 'places' => $places, 'reviews'=> $reviews ]);
    }

    public function edit($id)
    {
    	$user = Sentinel::findById($id);

    	return view('User.User.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
    	$user = User::find($id);
    	if($request->hasFile('avatar'))
    		{
    			$file = $request->file('avatar');
    			$destinationPath = 'uploads/avatar';
                $name = $file->hashName();
                $file->move($destinationPath,$name);

                $user->avatar = $name;
    		}
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->save();

    	return redirect()->back()->with('success', 'Update Profile Success');

    }
}
