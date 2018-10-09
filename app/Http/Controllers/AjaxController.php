<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sentinel;
use App\Models\Rate;
use App\Models\Comment;
use App\Models\ImageComment;

class AjaxController extends Controller
{
    public function showDistrict(Request $request)
    {
    	$city_name = $request->city;
    	$file = 'local.json';
		$json = json_decode(file_get_contents($file), true);
		$data = null;
		$district = null;
		foreach ($json as $city) {
			if($city_name == $city['name'])
			{
				$data = $city['quan-huyen'];
			}
		}
		if($data)
		{
			foreach ($data as $dis) {
				$district[] = $dis['name_with_type'];
			}
		}

    	return \Response::json(['array'=>$district]);
    }

    public function checkLogin()
    {
    	if(Sentinel::check())
    	{
    		 return \Response::json([        
                            'message' => 'success'                          
                        ], 200);
    	}
    	else
    	{
    		 return \Response::json([        
                            'message' => 'fail'                          
                        ], 200);
    	}
    }

    public function loadMore(Request $request)
    {
    	$output = '';
    	$id = $request->id;
    	$place_id = $request->place_id;

    	$comments = 
    	Comment::select('comments.*', 'comments.id as comment_id' , 'u.avatar', 'u.last_name', 'u.first_name')
            ->leftJoin('users as u', 'u.id' , 'comments.user_id')
            ->where('comments.place_id', $place_id)->orderBy('comments.created_at', 'desc')
            ->where('comments.id', '<', $id)
            ->limit(2)->get();
    	return view('User.Listing.loadMoreAjax', ['comments' => $comments]);
    }


    public function addReview(Request $request)
    {
    	
    	try {
    		$user_id = Sentinel::getUser()->id;
    		$place_id = $request->place_id;
    		$rate = $request->rate;
    		$content = $request->comment;
    		

    		$comment = new Comment();
	    	$comment->user_id = $user_id;
	    	$comment->place_id = $request->place_id;
	    	$comment->rate = $rate;
	    	$comment->content = $content;
	    	$comment->save();
            $comment_id = $comment->id;

	    	$newRate = Rate::where('place_id', $place_id)->where('user_id', $user_id)->first();
	    	if($newRate)
	    	{
	    		$newRate->star = $rate;
	    		$newRate->save();
	    	}
	    	else
	    	{
	    		$ratePlace = new Rate();
	    		$ratePlace->star = $rate;
	    		$ratePlace->user_id = $user_id;
	    		$ratePlace->place_id = $place_id;
	    		$ratePlace->save();
	    	}

              // upload anh?
             if ($request->hasFile('files')) {
                $no_files = count($_FILES["files"]['name']);
             for ($i = 0; $i < $no_files; $i++) {  
                    $image_comment = new ImageComment();

                    $uploaddir = './uploads/comment/';
                    $nameFile = basename($_FILES['files']['name'][$i]);
                    $nameArray = explode(".",$nameFile);
                    $uploadfile = $uploaddir.hash('md5',$nameArray[0]).$user_id.'.'.$nameArray[1];
                    move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadfile);

                    $image_comment->url = hash('md5',$nameArray[0]).$user_id.'.'.$nameArray[1];
                    $image_comment->place_id = $place_id;
                    $image_comment->user_id = $user_id;
                    $image_comment->comment_id = $comment_id;
                    $image_comment->save();
                //
                }
            }   

	    	return \Response::json([        
	                            'message' => 'success'                          
	                        ], 200);

    	} catch (Exception $e) {
    		return \Response::json([        
	                            'message' => 'fail'                          
	                        ], 200);
    	}  
    }
}
