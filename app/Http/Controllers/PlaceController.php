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

    // hien thi danh sach dia diem 
    public function list(Request $request)
    {
        $places = Place::select('*');

        if($request->has('category') && $request->input('category') != 0)
        {
          $places = $places->where('category_id', '=', $request->input('category'));
        }

         if($request->has('incress') && $request->input('incress') == 0)
        {
          $places = $places->orderBy('count_views', 'asc');
        }
        if($request->has('status'))
          $places = $places->where('status', $request->input('status'));

        if($request->input('name') !== NULL)
        {
          $places = $places->where('name', 'like', '%'.$request->input('name').'%');      
        }

        if($request->has('number') && $request->input('number') >0)
        {
           $places = $places->paginate($request->input('number'));
        }
        else
            $places = $places->paginate(2);
       
        $categories = Category::where('parent', ">", 0)->get();
        return view('Admin.place.list', [
            'places' => $places,
            'categories' => $categories
        ]);
    }

    public function tableAjax()
    {
        $places = Place::search(
            $params = [
                 'limit'=> $_GET['limit'], 
                  'category' => $_GET['category'],
                  'sort' => $_GET['sort'],
                  'status' => $_GET['status']
            ]
         );
        return view('Admin.place.table', ['places' => $places]);
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
    	$data['status'] = 1;
    	$data->category_id = $request->category_id;
    	$data->city = $request->city;
    	$data->district = $request->district;
    	$data->phone = $request->phone;
    	$data->website = $request->website;
    	$data->description = $request->description;
    	$open =  '01:00:00';
    	$close = '07:00:00';
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
