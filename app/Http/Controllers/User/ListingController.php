<?php

namespace App\Http\Controllers\User;

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

class ListingController extends Controller
{
    public function add()
    {
    	$services = Service::all();
    	$file = 'local.json';
    	$cities = json_decode(file_get_contents($file));
    	$categories_parent = Category::getParrent(0);
    	return view ('User.Listing.add', [
    		'services' => $services ,
    		'cities' => $cities,
    		'parent' => $categories_parent
    	]);
    }

    public function store(AddListingForm $request)
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

    //show detail lisiting
    public function detail($id)
    {
        $place = Place::find($id);
        if($place)
        {
            // update views
            $views = $place->count_views + 1; 
            $place->count_views = $views;
            $place->save();

           // lay tat ca service cua place do'
            $services = Place::select('places.id', 's.name')
            ->leftJoin('place_services as ps', 'ps.place_id', 'places.id')
            ->leftJoin('services as s', 'ps.service_id', 's.id')
            ->where('places.id', $place->id)->get();

            // lay tat ca cac anh? cua? dia dem
            $images = Image::where('user_id', $place->author_id)
            ->where('place_id', $place->id)->get();

            // get Rate 
            $star = Place::getRatePlace($place->id);
            
            // count comment
            $count_comment = Comment::where('place_id', $place->id)->count();

            //count reviews
            $count_review = Rate::where('place_id', $place->id)->count();

            //get User comment review
            $users = Comment::select(
                'comments.*', 'comments.id as comment_id' , 'u.avatar', 'u.last_name', 'u.first_name')
            ->leftJoin('users as u', 'u.id' , 'comments.user_id')
            ->where('place_id', $place->id)->orderBy('comments.created_at', 'desc')
            ->limit(2)->get();


            //dd($users->first()->images());

            //danh sach cac dia diem co rate cao nhat
            $topRate = Place::select('places.*', DB::raw('avg(r.star) as total_rate') )
            ->leftJoin('rates as r', 'places.id','r.place_id')
            ->groupBy('places.id')
            ->orderBy('total_rate', 'DESC')
            ->limit(5)->get();

            return view ('User.Listing.detail', [
                'place'=> $place, 
                'images' =>$images, 
                'services' => $services,
                'star' => $star,
                'count_review' => $count_review,
                'count_comment' => $count_comment,
                'users' => $users,
                'topRate' => $topRate
            ]);
        }
        else
        {
            return abort(404);
        }
        
    }

    //hien thi tat ca dia diem de? search + cac thao tac Search
    public function list(Request $request)
    {
        if(isset($_GET['name']))
        {
             $services = $request->getService;
             $name = $request->name;
             $category = $request->category;
             $distance = $request->distance;
             $lat = $request->lat;
             $lng = $request->lng;

            $places = Place::select('places.*', 'c.parent')
              ->leftJoin('categories as c', 'c.id' , 'places.category_id');

            if($name !== null)
            {
                $places->where('places.name', 'like', '%'.$name.'%');
            }

            if($category !==null)
            {
                $places->where('c.parent', $category);
            }

            

             if($services !== null)
                {
                     $array_service = explode(",",$services);
                    // tim nhung~ place co trong list service get dc
                     $place_services = Place::select('places.id')
                     ->leftJoin('place_services as ps', 'ps.place_id', 'places.id')
                     ->whereIn('ps.service_id', $array_service)
                     ->groupBy('places.id')
                     ->get();
                        
                    $places->whereIn('places.id', $place_services->toArray());
                }

            
           
           
           // xu li distance khoang cach
           if($lat !== null)
           {
                    $places->select('places.*',
                        DB::raw("ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS($lat) ) + COS( RADIANS( `lat` ) )* COS( RADIANS($lat)) * COS( RADIANS( `lng` ) - RADIANS($lng))) * 6380 AS distance") 
                )->havingRaw('distance <= '.$distance);

                    $items =$places->get();
                      // chuyen collection sang Paginate

                    $page = null;
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    $places = new LengthAwarePaginator(
                        $items->forPage($page, 2), 
                        $items->count(), 
                        2, // so item moi~ page
                        $page, 
                        $options =['path'=> 
                        'https://listing.vn/list-listing?name='.$name.'&category='.$category.'&distance='.$distance.'&getService='.$services.'&lat='.$lat.'&lng='.$lng]);
                    $result = $places;

           }
           else
           {
                     $result = $places->paginate(2); 
           }

        }
       
        else
        {
            $count_result = Place::all()->count();
            $result = Place::paginate(2);
        }

        $services = Service::all();
        $categories = Category::getParrent(0);

        //dd($result);

        return view('User.Listing.list', [
            'places' => $result,
            'services' => $services,
            'categories' => $categories
        ]);
    }
}