<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = "places";
    protected $guarded = ['id', 'created_at', 'updated_at'];

      public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
      public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

      public function countReview()
      {
        return $this->hasMany('App\Models\Rate')->count();
      }

      public static function  getRatePlace($id)
      {
            $star = 0.0;
            $rate = \App\Models\Rate::where('place_id', $id)->avg('star');
            if($rate !== null)
            $star = $rate;

            return $star;
      }

    //tinh' khoang cach giua~ 2 dia diem
    public function distance($lat2, $lon2) {

      $lat1 = $this->lat;
      $lon1 = $this->lng;

      $pi80 = M_PI / 180;
      $lat1 *= $pi80;
      $lon1 *= $pi80;
      $lat2 *= $pi80;
      $lon2 *= $pi80;

      $r = 6372.797; // mean radius of Earth in km
      $dlat = $lat2 - $lat1;
      $dlon = $lon2 - $lon1;
      $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
      $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
      $km = $r * $c;

      //echo '<br/>'.$km;
      return $km;
  }

  public static function search($params =[])
  {

    //dd($params);
    $places = self::select('places.*');

    if(isset($params['category']) && $params['category'] != 0)
    {
      $places->where('category_id', $params['category']);
    }
     if(isset($params['sort']) && $params['sort'] == 0)
    {
      $places->orderBy('count_views', 'asc');
    }
    if(isset($params['status']))
    $places->where('status', $params['status']);

    if(isset($params['limit']) && $params['limit'] >0)
        {
           return $places->paginate($params['limit']);
        }
     return $places->paginate(2);
  }
}
