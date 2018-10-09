<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = array(
     '1' => array('Shopping', 0),
	 '2'=> array('Drinking Eating', 0),
	 '3' => array('Travel', 0),
	 '4' => array('Wedding', 0),
	 '5' => array('Beauty and Health', 0),
	 '6' => array('Entertaiment', 0),
	 '8' => array('Mall', 1),
	 '9' => array('Super Market', 1),
	 '10' => array('Store', 1),
	 '11' => array('Cafe', 2),
	 '12' => array('Buffet', 2),
	 '13' => array('Bar/Pub', 2),
	 '14' => array('Beer Club', 2),
	 '15' => array('Restaurent', 2),
	 '16' => array('Resoft', 3),
	 '17' => array('Hotel', 3),
	 '18' => array('Airplane', 3),
	 '19'=> array('Tour', 3),
	 '20' => array('Photo Wedding', 4),
	 '21' => array('Host Wedding', 4),
	 '22' => array('Make Up', 4),
	 '23' => array('Uniform', 4),
	 '24' => array('Spa Massage', 5),
	 '25' => array('Skin Caring', 5),
	 '26' => array('Mi pham', 5),
	 '27' => array('Gaming Home', 6),
	 '28' => array('Lazzer Gun', 6),
	 '29' => array('Check in Place', 6),
	 '30' => array('Foody', 2)
	);

    	foreach ($data as $key => $value) {
    		 Category::create([
	           'name' => $value[0],
	           'parent' => $value[1]
	        ]);
    	}
				
    }
}
