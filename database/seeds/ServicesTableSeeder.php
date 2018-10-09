<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	'Wifi',
			'Online Reservation',
			'Events',
			 'Host',
			'Gaming House',
			'Event',
			'Park Center'
        );

        foreach ($data as $item) {
        	 Service::create([
	           'name' => $item
	        ]);
        }
    }
}
