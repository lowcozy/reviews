<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Place;
use App\Models\Image;
use App\Models\Rate;
use App\Models\Comment;
use App\Models\Place_Service;
use App\Models\Category;
use App\Http\Requests\User\AddListingForm;
use Sentinel;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class PlaceController extends Controller
{
    public function create()
    {
    	$services = Service::all();
    	$file = 'local.json';
    	$cities = json_decode(file_get_contents($file));
    	$cats = Category::where('parent', 0)->get();
    	return view('Admin.place.create', 
    		['cities' => $cities, 
    		 'cats' => $cats, 
    		 'services' => $services
    		]);
    }
    public function save(AddListingForm $request)
    {
    	 // them 1 dia diem moi'
    	$data = new Place();
    	$user_id = Sentinel::getUser()->id;
    	$data->name = $request->name;
    	$data->lat = $request->lat;
    	$data->lng = $request->lng;
    	$data['author_id'] = $user_id;
    	$data['status'] = 0;
    	$data->category_id = $request->category_id;
    	$data->city = $request->city;
    	$data->district = $request->district;
    	$data->phone = $request->phone;
    	$data->website = $request->website;
    	$data->description = $request->description;
    	$open =  $request->open_h.":".$request->open_m.":00";
    	$close = $request->close_h.":".$request->close_m.":00";
        $data->count_views = 0;
    	$data['open'] = $open;
    	$data['close'] = $close;
    	$data->save();


        //luu anh
        if ($request->hasFile('image')) {
            foreach ($request->image as $file) {
                $destinationPath = 'uploads/place';
                $name = $file->hashName();
                $file->move($destinationPath,$name);

                //them anh? vao` DB
                $image = new Image();
                $image->place_id = $data->id;
                $image->url = $name;
                $image->status = 0;
                $image->user_id = $data->author_id;
                $image->save();
            }
        }   

        // them các service vao` dia điểm
    	$services = $request->service;
    	foreach ($services as $item) {
    		$place_service = new Place_Service();
    		$place_service->service_id = $item;
    		$place_service->place_id = $data->id;
    		$place_service->save();
     	}

    	return redirect()->route('home');
    }
}
